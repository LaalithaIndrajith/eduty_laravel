<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Exception;
use App\Client;
use App\JobSteps;
use App\TaskFlow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        // $isadmin = Auth::user()->user_is_system_admin;

        // if($isadmin == 1)
        // {
        //     $this->middleware(['auth', 'isSystemAdmin']);
        // }else{
            $this->middleware(['auth', 'routeClearance']);
        // }
    }

    public function index(){
        $customers = Client::getAllClients();
        $taskflows = TaskFlow::getAllTaskflows();
        $num = $this->getLastNum();
        $jobNum = $this->generateJobNum($num);
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Jobs',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Job Tickets',
                'page' => '#',
            ],
        ];

        $page_title = 'Issue Job Ticket';
        $page_description = 'Issue Job Ticket ';

        $data  = array(
            'customers' => $customers,
            'taskflows' => $taskflows,
        );

        return view('pages.jobs.create_job', compact('page_title','page_breadcrumbs','data','jobNum'));
    }
    
    public function viewJobTicketList(){
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Jobs',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Job Tickets',
                'page' => '#',
            ],
        ];

        $page_title       = 'Job Ticket List';
        $page_description = 'Information of all the Job Tickets';

        return view('pages.jobs.job_ticket_list', compact('page_title','page_breadcrumbs',));
    }
    
    public function viewAllocatedJobList(){
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Jobs',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Job Tickets',
                'page' => '#',
            ],
        ];

        $page_title       = 'Job Ticket List';
        $page_description = 'Information of all the Job Tickets';

        return view('pages.jobs.allocated_job_list', compact('page_title','page_breadcrumbs',));
    }

    public function viewAllocatedJobForEdit($allocatedJobId){
        $allocaltedJoDetails = JobSteps::find($allocatedJobId);
        dd($allocaltedJoDetails);
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Jobs',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Customers',
                'page' => '#',
            ],
        ];

        $page_title = 'Edit Customer';

        return view('pages.clients.edit_client', compact('page_title','page_breadcrumbs','client'));
    }

    public function issueJobTicket(Request $request){
        DB::beginTransaction();
        try{
            $num = $this->getLastNum();
            $createdAt = date('Y-m-d H:i:s');
            $client = Client::find($request->customer_select);
            $taskflow = TaskFlow::find($request->taskflow_select);
            $tasks = Task::with(['designation'])->where('taskflow_id',$request->taskflow_select)->where('task_status',1)->orderBy('task_step_no', 'asc')->get();
            $jobAllocationId = DB::table('clients_has_taskflows')->insertGetId(
                [
                    'client_id' => $request->customer_select, 
                    'taskflow_id' => $request->taskflow_select,
                    'job_allocation_no' => $request->job_allocation_no,
                    'number' => $num,
                    'job_ticket_status' => 'ISSUED',
                    'job_allocation_created_by' => auth()->user()->id,
                    'job_allocation_created_at' => $createdAt,
                ]
            );
            $this->storeJobStepDetails($tasks,$jobAllocationId);
            // dd('here');
            DB::commit(); 
            $issueJobTicket = [
                'msg' =>  'Job Ticket issued to the system successfully ',
                'title' => 'Issue Job Ticket',
                'status' =>  true,
            ];

            return $issueJobTicket;
        }catch(Exception $e){
            DB::rollback();
            $issueJobTicket = [
                'msg' =>  'Job Ticket is not issued, Please try again ',
                'title' => 'Problem Occured',
                'status' =>  false,
            ];

            return $issueJobTicket;
        }
    }

    private function storeJobStepDetails($tasks,$jobAllocationId){
        $i = 1;
        foreach($tasks as $task){
            $jobStep = new JobSteps;
            $jobStep->step_iteration_num     = $i;
            $jobStep->job_allocation_id      = $jobAllocationId;
            $jobStep->job_task_step_number   = $task->task_id;
            $jobStep->job_task_step_assignee = $task->designation_id;
            $jobStep->job_task_step_status   = ($i == 1) ? 'AVAI' : 'PND';
            if($i == 1){
                $jobStep->step_available_at      = date('Y-m-d H:i:s');
            }
            $jobStep->step_milestone_type    = $task->task_milestone_time_type;
            $jobStep->step_milestone_time    = $task->task_milestone_time;
            $jobStep->save();
            $i++;
        }
    }

    private function getLastNum(){
        
        $num = DB::table('clients_has_taskflows')->max('number');
        if($num == null){
            $num = 1; 
        }else{
            $num += 1; 
        }

        return $num;
       
    }

    private function generateJobNum($num){
        $date = date('Ymd');
        $JobCode    = 'JOB';
        $jobNo = $JobCode.'-' .$date . str_pad($num , 5, "-0000", STR_PAD_LEFT);

        return $jobNo;
    }

    public function getCustomerDetails(Request $request){
        $clientId = $request->custId;
        $client = Client::find($clientId);
        return $client;
    }
   
    public function getTaskflowDetails(Request $request){
        $taskflowId = $request->taskflowId;
        $taskflow = TaskFlow::with(['department'])->where('taskflow_id',$taskflowId)->get();
        $tasks = Task::with(['designation'])->where('taskflow_id',$taskflowId)->where('task_status','1')->orderBy('task_step_no', 'asc')->get();
        return array(
            'taskflow' => $taskflow,
            'tasks' => $tasks,
        );
    }

    private function backupFetchData($jobAllocationId){
        $details = DB::table('clients_has_taskflows')
        ->join('taskflows', 'clients_has_taskflows.taskflow_id', '=', 'taskflows.taskflow_id')
        ->join('clients', 'clients_has_taskflows.client_id', '=', 'clients.client_id')
        ->select('clients_has_taskflows.*', 'taskflows.*', 'clients.*')
        ->where('job_allocation_id', $jobAllocationId)
        ->get();
    }

    public function fetchJobTicketsToDrawTbl(){
        if(request()->session()->get('userType') == 'ADMIN'){
            $departId = auth()->user()->depart_id;
            $jobs = DB::table('clients_has_taskflows')
            ->join('taskflows', 'clients_has_taskflows.taskflow_id', '=', 'taskflows.taskflow_id')
            ->join('clients', 'clients_has_taskflows.client_id', '=', 'clients.client_id')
            ->select('clients_has_taskflows.*', 'taskflows.*', 'clients.*')
            ->where('taskflows.depart_id',$departId)
            ->get();
        }else{
            $jobs = DB::table('clients_has_taskflows')
            ->join('taskflows', 'clients_has_taskflows.taskflow_id', '=', 'taskflows.taskflow_id')
            ->join('clients', 'clients_has_taskflows.client_id', '=', 'clients.client_id')
            ->select('clients_has_taskflows.*', 'taskflows.*', 'clients.*')
            ->get();
        }
        
        $data = array();
        
        foreach($jobs as $job){
            $d = array();
            $d['jobNumDetails'] = array(
                'num'=> $job->job_allocation_no,
                'id'=>$job->job_allocation_id,
            );
            $d['customerDetails'] =  array(
                'name'=> $job->client_title.' . '.$job->client_fname. ' '.$job->client_lname,
                'contact'=> $job->client_contact,
            );
            $d['taskflowDetails'] =  array(
                'name'=> $job->task_flow_name,
                'code'=> $job->task_flow_code,
            );
            $d['progress'] =  $this->getProgressOfTaskflow($job->job_allocation_id);
            $d['issuedDetails'] =  array(
                'issuedAt'=> $job->job_allocation_created_at,
                'issuedBy'=> User::getUsername($job->job_allocation_created_by),
            );
            $d['status'] = $job->job_ticket_status;
            $d['jobId'] = $job->job_allocation_id;
            array_push($data, $d);
        }

        $result = array(
			'data' => $data
		);
        
        return $result;

    }

    public function getProgressOfTaskflow($jobAllocationId){
        $totalTaskCount = DB::table('job_task_steps')->where('job_allocation_id',$jobAllocationId)->count();
        $completedCount = DB::table('job_task_steps')->where('job_allocation_id',$jobAllocationId)->where('job_task_step_status','COMP')->count();
        $progress = ($completedCount == 0 ) ? 0 : ($completedCount/$totalTaskCount) * 100 ;

        return array(
            'completed' => $completedCount,
            'total' => $totalTaskCount,
            'progress' => $progress,
        );

    }

    public function fetchAllocatedJobsToDrawTbl(){
        $designationId = auth()->user()->designation_id;
        $allocatedJobs = DB::table('job_task_steps')
        ->join('clients_has_taskflows', 'job_task_steps.job_allocation_id', '=', 'clients_has_taskflows.job_allocation_id')
        ->join('designations', 'job_task_steps.job_task_step_assignee', '=', 'designations.designation_id')
        ->join('tasks', 'job_task_steps.job_task_step_number', '=', 'tasks.task_id')
        ->select('clients_has_taskflows.*', 'job_task_steps.*', 'designations.*','tasks.*')
        ->where('job_task_step_assignee',$designationId)
        ->where('job_task_step_status', '!=','PND')
        ->get();

        $data = array();
        foreach($allocatedJobs as $allocatedJob){
            
            $d = array();
            $d['jobNumDetails'] = array(
                'num'=> $allocatedJob->job_allocation_no,
                'id'=>$allocatedJob->job_allocation_id,
            );
            $d['designationDetails'] =  array(
                'code'=> $allocatedJob->designation_code,
                'name'=> $allocatedJob->designation_name,
            );
            $d['taskDetails'] =  array(
                'name'=> $allocatedJob->task_name,
                'time_type'=> $allocatedJob->task_milestone_time_type,
                'time_value'=> $allocatedJob->task_milestone_time,
            );
            $d['overview'] =  $this->getProgressOfTaskflow($allocatedJob->job_allocation_id);
            $d['status'] = $allocatedJob->job_task_step_status;
            $d['jobId'] = $allocatedJob->job_task_step_id;
            $d['efficiency'] = array(
                'isAheadTime' => $this->calOverdue($allocatedJob),
                'availableAt' => $allocatedJob->step_available_at,
            );

            array_push($data, $d);
        }

        $result = array(
			'data' => $data
		);
        
        return $result;

    }

    private function calOverdue($allocatedJob){
        $dtNow = Carbon::now();
        $dtAvai = Carbon::create($allocatedJob->step_available_at) ;
        $type = $allocatedJob->task_milestone_time_type;
        $time = $allocatedJob->task_milestone_time;
        
        if($type == 'mins'){
            $dtAvai->addMinutes($time);
        }else if($type == 'hours'){
            $dtAvai->addHours($time);
        }else if($type == 'days'){
            $dtAvai->addDays($time);
        }
        return $dtNow->lessThanOrEqualTo($dtAvai);

    }
}
