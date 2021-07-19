<?php

namespace App\Http\Controllers;

use App\Task;
use Exception;
use App\Client;
use App\JobSteps;
use App\TaskFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $isadmin = Auth::user()->user_is_system_admin;

        if($isadmin == 1)
        {
            $this->middleware(['auth', 'isSystemAdmin']);
        }else{
            $this->middleware(['auth', 'routeClearance']);
        }
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
                    'job_allocation_created_by' => auth()->user()->id,
                    'job_allocation_created_at' => $createdAt,
                ]
            );
            $this->storeJobStepDetails($tasks,$jobAllocationId);
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
        foreach($tasks as $task){
            $jobStep = new JobSteps;
            $jobStep->job_allocation_id              = $jobAllocationId;
            $jobStep->job_task_step_number           = $task->task_step_no;
            $jobStep->job_task_step_assignee           = $task->designation_id;
            $jobStep->job_task_step_status           = 'PND';
            $jobStep->save();
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
}
