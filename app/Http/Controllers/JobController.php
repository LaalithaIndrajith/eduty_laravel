<?php

namespace App\Http\Controllers;

use App\Task;
use Exception;
use App\Client;
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

        return view('pages.jobs.create_job', compact('page_title','page_breadcrumbs','data'));
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
        // try{
            $client = Client::find($request->customer_select);
            $taskflow = TaskFlow::find($request->taskflow_select);
            $id = DB::table('clients_has_taskflows')->insertGetId(
                ['client_id' => $request->customer_select, 'taskflow_id' => $request->taskflow_select]
            );
           
            $details = DB::table('clients_has_taskflows')
            ->join('taskflows', 'clients_has_taskflows.taskflow_id', '=', 'taskflows.taskflow_id')
            ->join('clients', 'clients_has_taskflows.client_id', '=', 'clients.client_id')
            ->select('clients_has_taskflows.*', 'taskflows.*', 'clients.*')
            ->where('job_allocation_id', $id)
            ->get();
            dd($details);

        // }catch(Exception $e){

        // }
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
}
