<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'routeClearance']);
    }

    public function viewMonthlyOverAllReport(){
       
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Reports',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Monthly Reports',
                'page' => '#',
            ],
        ];

        $page_title = 'Job Ticket Overview';

        return view('pages.reports.monthly_overall_overview', compact('page_title','page_breadcrumbs'));
    }

    public function getMonthlyOverviewJobTickets(Request $request){

        $jobTickets = DB::table('clients_has_taskflows')
        ->join('taskflows', 'clients_has_taskflows.taskflow_id', '=', 'taskflows.taskflow_id')
        ->where('clients_has_taskflows.job_allocation_created_at','<=',$request->endOfMonth)
        ->where('clients_has_taskflows.job_allocation_created_at','>=',$request->startOfMonth)
        ->get();

        $jobTicketCountDeps = DB::table('clients_has_taskflows')
        ->join('taskflows', 'clients_has_taskflows.taskflow_id', '=', 'taskflows.taskflow_id')
        ->where('clients_has_taskflows.job_allocation_created_at','<=',$request->endOfMonth)
        ->where('clients_has_taskflows.job_allocation_created_at','>',$request->startOfMonth)
        ->select('taskflows.depart_id', DB::raw('count(*) as total'))
        ->groupBy('taskflows.depart_id')
        ->orderBy('total','desc')
        ->get();
    

        if($jobTickets->count() != 0){
            $issuedJobTicketCount = sizeof($jobTickets);
            $timeAheadArr = array();
            $overdueArr = array();
            foreach($jobTickets as $jobTicket){
                $completionTime = $this->jobTicketComplteTime($jobTicket);
                $tasks          = $this->getTasksOfTaskflow($jobTicket->job_allocation_id);
                $allocatedTime  = $this->calTotalTaskflowTime($tasks);
                $isOverDue      = $this->isOverdueJobTicket($allocatedTime,$completionTime);
                ($isOverDue) ? array_push($overdueArr,$jobTicket->job_allocation_id) :array_push($timeAheadArr,$jobTicket->job_allocation_id);
            }
    
            $overdueJobTicketCount = sizeof($overdueArr);
            $aheadJobTicketCount = sizeof($timeAheadArr);
            $overdueDetails = array(
                'count'      => $overdueJobTicketCount,
                'percentage' => ($overdueJobTicketCount/$issuedJobTicketCount) * 100,
            );
            $aheadTimeDetails = array(
                'count'      => $aheadJobTicketCount,
                'percentage' => ($aheadJobTicketCount/$issuedJobTicketCount) * 100,
            );

            $departOverallArr = $this->arranageDepartOverallStats($jobTicketCountDeps,$jobTickets,$issuedJobTicketCount,$overdueJobTicketCount,$aheadJobTicketCount);
            
            return array(
                'foundJobTickets'        => true,
                'issuedJobTicketCount'   => $issuedJobTicketCount,
                'overdueDetails'         => $overdueDetails,
                'aheadTimeDetails'       => $aheadTimeDetails,
                'departmentOverviewData' => $departOverallArr,
            );
            
        }else{
            return array(
                'foundJobTickets' => false,
                'departmentOverviewData' => [],
            );
        }
    }

    //Calculate Total Time of
    private function jobTicketComplteTime($jobticket){
        if($jobticket->job_ticket_status == 'COMP'){
            $completed = Carbon::create($jobticket->job_ticket_completed_at);
            $created   = Carbon::create($jobticket->job_allocation_created_at);
            $diffrence = $created->diff($completed);
            return array(
                'days'  => $diffrence->d,
                'hours' => $diffrence->h,
                'mins'  => $diffrence->i,
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
    public function getTasksOfTaskflow($jobAllocationId){
        $tasks = DB::table('job_task_steps')
        ->join('tasks', 'job_task_steps.job_task_step_number', '=', 'tasks.task_id')
        ->join('designations', 'job_task_steps.job_task_step_assignee', '=', 'designations.designation_id')
        ->select('tasks.*', 'job_task_steps.*','designations.*')
        ->where('job_task_steps.job_allocation_id',$jobAllocationId)
        ->get();

        return $tasks;
    }

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

    //Arrange Department Overview Details in Overall Overview
    public function arranageDepartOverallStats($jobTicketCountDeps, $jobTickets, $issuedJobCount, $overdueJobCount, $aheadJobCount){

        $departOverallArr = array();
        foreach($jobTicketCountDeps as $dep){
            $depId = $dep->depart_id;
            $jobticketArr = array();
            $timeAheadArr = array();
            $overdueArr = array();
            foreach($jobTickets as $jobTicket){
                if($jobTicket->depart_id == $depId){
                    $completionTime = $this->jobTicketComplteTime($jobTicket);
                    $tasks          = $this->getTasksOfTaskflow($jobTicket->job_allocation_id);
                    $allocatedTime  = $this->calTotalTaskflowTime($tasks);
                    $isOverDue      = $this->isOverdueJobTicket($allocatedTime,$completionTime);
                    ($isOverDue) ? array_push($overdueArr,$jobTicket->job_allocation_id) :array_push($timeAheadArr,$jobTicket->job_allocation_id);
                    // array_push($jobticketArr,$jobTicket);
                }
            }
            $details = [
                'depName'      => Department::getDepName($depId),
                'overdueDetails'   => array(
                    'count' => sizeof( $overdueArr),
                    'percentage' => (sizeof( $overdueArr)/$overdueJobCount)*100,
                    'totalOverDue' => $overdueJobCount,
                ),
                'timeAheadDetails'   => array(
                    'count' => sizeof( $timeAheadArr),
                    'percentage' => (sizeof( $timeAheadArr)/$aheadJobCount)*100,
                    'totalTimeAhead' => $aheadJobCount,
                ),
                'totalCountDetails'   => array(
                    'count' => $dep->total,
                    'percentage' => ($dep->total/$issuedJobCount)*100,
                    'totalIssued' => $issuedJobCount,
                ),
                // 'jobTicketArr' => $jobticketArr
            ];
            array_push($departOverallArr,$details);
        }

        return array(
            'data' => $departOverallArr,
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
}
