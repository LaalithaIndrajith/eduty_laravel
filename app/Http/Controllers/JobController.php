<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Exception;
use App\Client;
use App\Department;
use App\Events\newJobTicketIssuedEvent;
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
            $jobTicketDetails = $this->getJobTickeNumberForMail($jobAllocationId);
            // dd('here');
            if($client->client_email != ''){
                event(new newJobTicketIssuedEvent($client,$jobTicketDetails, $taskflow));
            }
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

    //getting jobticket details for mail
    private function getJobTickeNumberForMail($jobTicketId){
        $jobTicketNum = DB::table('clients_has_taskflows')
        ->where('job_allocation_id',$jobTicketId)
        ->value('job_allocation_no');

        return $jobTicketNum;
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

    //fetch details for the view modal - Job Ticket Details
    public function fetchJobTicketDetails(Request $request){

        $jobTicketId = $request->jobTicketId;
        $jobTicketDetails = DB::table('clients_has_taskflows')
            ->join('taskflows', 'clients_has_taskflows.taskflow_id', '=', 'taskflows.taskflow_id')
            ->join('clients', 'clients_has_taskflows.client_id', '=', 'clients.client_id')
            ->select('clients_has_taskflows.*', 'taskflows.*', 'clients.*')
            ->where('clients_has_taskflows.job_allocation_id',$jobTicketId)
            ->get();
        $tasks = $this->getJobTaskDetails($jobTicketDetails[0]->job_allocation_id);
        $taskflowTime = $this->calTotalTaskflowTime($tasks);
        $taskDetails = $this->arrangeTaskDetails($tasks);
        $jobtacketCompleteTime = $this->jobTicketComplteTime($jobTicketDetails[0]);
        $isOverdueJobTicket = $this->isOverdueJobTicket($taskflowTime,$jobtacketCompleteTime);
        return array(
            'jobDetails'=> $jobTicketDetails[0],
            'issuedByName' => User::getUsername($jobTicketDetails[0]->job_allocation_created_by),
            'departName' => Department::getDepName($jobTicketDetails[0]->depart_id),
            'progress' => $this->getProgressOfTaskflow($jobTicketDetails[0]->job_allocation_id),
            'taskDetials' => $taskDetails,
            'jobTicketCompleteTime' => $jobtacketCompleteTime,
            'allocatedJobTicketTime' => $taskflowTime,
            'isJobTicketOverdue' => $isOverdueJobTicket,

        );
        
    }

    public function getJobTaskDetails($jobAllocationId){
        $jobTasks = DB::table('job_task_steps')
        ->join('tasks', 'job_task_steps.job_task_step_number', '=', 'tasks.task_id')
        ->join('designations', 'job_task_steps.job_task_step_assignee', '=', 'designations.designation_id')
        ->select('tasks.*', 'job_task_steps.*','designations.*')
        ->where('job_task_steps.job_allocation_id',$jobAllocationId)
        ->get();

        return $jobTasks;
    }

    public function arrangeTaskDetails($tasks){
        $data = array();
        
        foreach($tasks as $task){
            $d = array();
            $d['taskId'] = $task->task_id;
            $d['taskStep'] = $task->step_iteration_num;
            $d['taskName'] = $task->task_name;
            $d['taskAssignee'] = $task->designation_name;
            $d['designationCode'] = $task->designation_code;
            $d['taskTakenBy'] = User::getUsername($task->job_task_step_taken_by);
            $d['taskAllocatedTime'] = array(
                'type'=> $task->task_milestone_time_type,
                'value'=>$task->task_milestone_time,
            );
            $d['status'] = $task->job_task_step_status;
            $d['avilableAt'] = $task->step_available_at;
            $d['takenAt'] = $task->job_task_step_taken_at;
            $d['completedAt'] = $task->job_task_step_completed_at;
            $d['rejectedAt'] = $task->step_rejected_at;
            $d['isOverdue'] = $task->job_task_step_is_overdue;
            $d['timeTaken'] = $this->calculateTimeTakenForTask($task);
            array_push($data, $d);
        }

        $result = array(
			'data' => $data
		);
        
        return $result;
    }

    private function calculateTimeTakenForTask($task){
        if($task->job_task_step_status == 'COMP'){
            $completed = Carbon::create($task->job_task_step_completed_at);
            $available = Carbon::create($task->step_available_at);
            $diffrence =  $available->diff($completed);
            return array(
                'days' => $diffrence->d,
                'hours' => $diffrence->h,
                'mins' => $diffrence->i,
            );
        }else if($task->job_task_step_status == 'ONG'){
            return 'Ongoing';
        }else if($task->job_task_step_status == 'REJECT'){
            return 'Rejected';
        }else if($task->job_task_step_status == 'ABN'){
            return 'Abandoned';
        }else if($task->job_task_step_status == 'AVAI'){
            return 'Pending';
        }else if($task->job_task_step_status == 'PND'){
            return 'Not Available to Take';
        }
    }
    
    private function jobTicketComplteTime($jobticket){
        if($jobticket->job_ticket_status == 'COMP'){
            $completed = Carbon::create($jobticket->job_ticket_completed_at);
            $created = Carbon::create($jobticket->job_allocation_created_at);
            $diffrence =  $created->diff($completed);
            return array(
                'days' => $diffrence->d,
                'hours' => $diffrence->h,
                'mins' => $diffrence->i,
            );
        }else if($jobticket->job_ticket_status == 'ONG'){
            return $this->calculateNonCompletedJobTicktDuration($jobticket);
            // return 'Ongoing';
        }else if($jobticket->job_ticket_status == 'REJECT'){
            return $this->calculateRejectedJobTicketDuration($jobticket);
            // return 'Rejected';
        }else if($jobticket->job_ticket_status == 'AVAI'){
            return $this->calculateNonCompletedJobTicktDuration($jobticket);
            // return 'Pending';
        }else if($jobticket->job_ticket_status == 'ISSUED'){
            return $this->calculateNonCompletedJobTicktDuration($jobticket);
            // return 'Pending';
        }
    }

    private function calculateNonCompletedJobTicktDuration($jobticket){
        $now = Carbon::now();
        $created = Carbon::create($jobticket->job_allocation_created_at);
        $diffrence =  $created->diff($now);
        return array(
            'days' => $diffrence->d,
            'hours' => $diffrence->h,
            'mins' => $diffrence->i,
        );
    }

    private function calculateRejectedJobTicketDuration($jobticket){
        $rejected = Carbon::create($jobticket->job_ticket_rejected_at);
        $created = Carbon::create($jobticket->job_ticket_started_at);
        $diffrence =  $created->diff($rejected);
        return array(
            'days' => $diffrence->d,
            'hours' => $diffrence->h,
            'mins' => $diffrence->i,
        );
    }

    //calculate the allocated time by the system
    private function calTotalTaskflowTime($tasks){
        $now = Carbon::now();
        $dt = Carbon::now();
        foreach($tasks as $task){
            $type = $task->task_milestone_time_type;
            $value = $task->task_milestone_time;

            if($type == 'mins'){
                $dt->addMinutes($value);
            }else if($type == 'hours'){
                $dt->addHours($value);
            }else if($type == 'days'){
                $dt->addDays($value);
            }
            
        }

        $diffrence = $dt->diff($now);
        return array(
            'days' => $diffrence->d,
            'hours' => $diffrence->h,
            'mins' => $diffrence->i,
        );
    }

    //calculate jo is overdue or not
    private function isOverdueJobTicket($taskflowTime,$jobticketCompleteTime){
        $taskflow = $this->getComparebleDate($taskflowTime);
        $duration = $this->getComparebleDate($jobticketCompleteTime);
        $isOverDue = ($duration->lessThan($taskflow)) ? false : true;
        return $isOverDue;
       
    }

    private function getComparebleDate($dateObj){
        $date = Carbon::now();
        $date->addDays($dateObj['days']);
        $date->addHours($dateObj['hours']);
        $date->addMinutes($dateObj['mins']);

        return $date;
        
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
        ->where('job_task_step_status','AVAI')
        ->orWhere('job_task_step_taken_by', auth()->user()->id)
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

        if($allocatedJob->job_task_step_status == 'REJECT'){
            return 'reject';
        }else if($allocatedJob->job_task_step_status == 'ABN'){
            return 'abandoned';
        }else{
            if($allocatedJob->job_task_step_taken_at == null){
                return 'notTaken';
            }else if($allocatedJob->job_task_step_completed_at == null){
                $taken = Carbon::create($allocatedJob->job_task_step_taken_at);
                
                if($type == 'mins'){
                    $taken->addMinutes($time);
                }else if($type == 'hours'){
                    $taken->addHours($time);
                }else if($type == 'days'){
                    $taken->addDays($time);
                }
                $result = ($dtNow->lessThanOrEqualTo($taken)) ? 'aheadTime': 'overdue';
                return $result;
                
            }else{
                $completed = Carbon::create($allocatedJob->job_task_step_completed_at) ;
                if($type == 'mins'){
                    $completed->addMinutes($time);
                }else if($type == 'hours'){
                    $completed->addHours($time);
                }else if($type == 'days'){
                    $completed->addDays($time);
                }
                $result = ($dtNow->lessThanOrEqualTo($completed)) ? 'aheadTime': 'overdue';
                return $result;
            }

        }


    }

    /** 
    ---------------------------------------------
      Task Actions
    ---------------------------------------------
    */

    //Take Task
    public function takeTask(Request $request){
        DB::beginTransaction();
        try{
            $allocatedJob = JobSteps::find($request->jobTaskId);
            $allocatedJob->job_task_step_taken_by = auth()->user()->id;
            $allocatedJob->job_task_step_taken_at = date('Y-m-d H:i:s');
            $allocatedJob->job_task_step_status = 'ONG';
            $allocatedJob->save();

            if($allocatedJob->step_iteration_num == 1){
                $this->makeJobTicketOngoing($allocatedJob->job_allocation_id);
            }
            DB::commit(); 
            $tasktaken = [
                'msg' =>  'Task is taken successfully',
                'title' => 'Task taken',
                'status' =>  true,
            ]; 


            return $tasktaken;

        }catch(Exception $e){
            DB::rollback();
            $tasktaken = [
                'msg' =>  'Task is not taken, Try again',
                'title' => 'Problem Occurred',
                'status' =>  false,
            ]; 
            return $tasktaken;
        }
       
    }

    public function makeJobTicketOngoing($jobAllocationId){
        DB::table('clients_has_taskflows')
        ->where('job_allocation_id', $jobAllocationId)
        ->update([
            'job_ticket_status' => 'ONG',
            'job_ticket_started_at' => date('Y-m-d H:i:s'),
        ]);
    }
    
    //Complete Task
    public function completeTask(Request $request){
        DB::beginTransaction();
        try{
            $allocatedJob = JobSteps::find($request->jobTaskId);
            $allocatedJob->job_task_step_status       = 'COMP';
            $allocatedJob->job_task_step_completed_by = auth()->user()->id;
            $allocatedJob->job_task_step_completed_at = date('Y-m-d H:i:s');
            $allocatedJob->save();

            $nextStep = $this->findNextIterativeStep($allocatedJob->job_allocation_id,$allocatedJob->step_iteration_num);
            if($nextStep == 0){
                $this->makeJobTicketCompleted($allocatedJob->job_allocation_id);
            }else{
                //available next job step for the system
                $nextJobStep = JobSteps::where('job_allocation_id',$allocatedJob->job_allocation_id)
                ->where('step_iteration_num',$nextStep)
                ->get();
                $this->makeAvailableNextStep($nextJobStep[0]);
                $nextJobStep[0]->save();

            }

            DB::commit(); 
            $taskComplete = [
                'msg' =>  'Task completed successfully',
                'title' => 'Task Completion',
                'status' =>  true,
            ]; 

            return $taskComplete;

        }catch(Exception $e){
            DB::rollback();
            $taskComplete = [
                'msg' =>  'Task is not completed, Try again',
                'title' => 'Problem Occurred',
                'status' =>  false,
            ]; 
            return $taskComplete;
        }
    }

    public function makeJobTicketCompleted($jobAllocationId){
        DB::table('clients_has_taskflows')
        ->where('job_allocation_id', $jobAllocationId)
        ->update([
            'job_ticket_status' => 'COMP',
            'job_ticket_completed_at' => date('Y-m-d H:i:s'),
        ]);
    }

    //Reject Task
    public function rejectTask(Request $request){
        DB::beginTransaction();
        try{
            $allocatedJob = JobSteps::find($request->jobTaskId);
            $allocatedJob->job_task_step_status      = 'REJECT';
            $allocatedJob->job_task_step_rejected_by = auth()->user()->id;
            $allocatedJob->step_rejected_at          = date('Y-m-d H:i:s');
            $allocatedJob->job_rejected_reason       = $request->rejectedReason;
            $allocatedJob->save();

            $this->makeJobTicketRejected($allocatedJob->job_allocation_id);

            $jobsToAbandoned = JobSteps::where('job_allocation_id',$allocatedJob->job_allocation_id)
            ->where('step_iteration_num','>',$allocatedJob->step_iteration_num)
            ->get();

            foreach($jobsToAbandoned as $job){
                $job->job_task_step_status = 'ABN';
                $job->step_rejected_at = date('Y-m-d H:i:s');
                $job->save();
            }

            DB::commit(); 
            $taskComplete = [
                'msg' =>  'Task rejected successfully',
                'title' => 'Task Rejection',
                'status' =>  true,
            ]; 

            return $taskComplete;

        }catch(Exception $e){
            DB::rollback();
            $taskComplete = [
                'msg' =>  'Task is not rejected, Try again',
                'title' => 'Problem Occurred',
                'status' =>  false,
            ]; 
            return $taskComplete;
        }
    }

    public function makeJobTicketRejected($jobAllocationId){
        DB::table('clients_has_taskflows')
        ->where('job_allocation_id', $jobAllocationId)
        ->update([
            'job_ticket_status' => 'REJECT',
            'job_ticket_rejected_at' => date('Y-m-d H:i:s'),
        ]);
    }

    private function abandonedTaskAfterReject($step, $jobTicketId){
        DB::table('job_task_steps')
        ->where('job_allocation_id', $jobTicketId)
        ->where('step_iteration_num', $step)
        ->update([
            'job_task_step_status' => 'ABN',
            'step_rejected_at' => date('Y-m-d H:i:s'),
        ]);

    }

    private function findNextIterativeStep($jobTicketId,$currentSetpNo){

        $maxiItrStepNum = DB::table('job_task_steps')
        ->where('job_allocation_id',$jobTicketId)
        ->max('step_iteration_num');
        
        if($maxiItrStepNum == $currentSetpNo){
            $nextItrSetp = 0;
        }else{
            $nextItrSetp = $currentSetpNo + 1;
        }
        return $nextItrSetp;

    }
    
    public function makeAvailableNextStep($nextJobStep){

        $nextJobStep->job_task_step_status = 'AVAI';
        $nextJobStep->step_available_at    = date('Y-m-d H:i:s');

    }
    
}
