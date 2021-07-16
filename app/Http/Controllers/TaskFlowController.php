<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use Exception;
use App\TaskFlow;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskFlowController extends Controller
{
    public function index(){
        $departments = Department::fetchAllDepartments();
        $timeTypes = array( 'mins','hours','days');
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Task Flows',
                'page' => '#',
            ],
            
        ];

        $page_title       = 'TaskFlow Creation';
        $page_description = 'Create task flow for the Departments';

        return view('pages.task_flows.task_flow_create', compact('page_title','page_breadcrumbs','departments','timeTypes'));
    }
    
    public function viewTaskFlowList(){
        
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Task Flows',
                'page' => '#',
            ],
            
        ];

        $page_title       = 'TaskFlow List';
        $page_description = 'Information of all the TaskFlows';

        return view('pages.task_flows.task_flow_list', compact('page_title','page_breadcrumbs',));
    }

    public function createTaskFlow(Request $request){
        DB::beginTransaction();
        try{
            $taskFlow = new TaskFlow;
            $taskFlow->depart_id           = $request->department_select;
            $taskFlow->task_flow_code      = $request->taskflow_code;
            $taskFlow->task_flow_name      = $request->taskflow_name;
            $taskFlow->taskflow_status     = $request->taskflow_status;
            $taskFlow->taskflow_cretaed_by = auth()->user()->id;
            $taskFlow->taskflow_updated_by = auth()->user()->id;
            $taskFlow->save();
            $this->storeTaskData($request,$taskFlow->taskflow_id);
            DB::commit(); 
            $taskFlowCreation = [
                'msg' =>  'TaskFlow creation is successful',
                'title' => 'TaskFlow Creation',
                'status' =>  1,
            ];

            $request->session()->flash('taskFlowCreation', $taskFlowCreation);  
        }catch(Exception $e){
            DB::rollback();
            $taskFlowCreation = [
                'msg' =>  'TaskFlow creation is unsuccessful',
                'title' => 'TaskFlow Creation',
                'status' =>  0,
            ];

            $request->session()->flash('taskFlowCreation', $taskFlowCreation);  
        }

        return redirect()->route('taskflowCreationView');
    }

    private function storeTaskData(Request $request, $taskFlowId){
        $taskNames = $request->task_name;
        $designations = $request->designation_select;
        $milestoneTypes = $request->milestone_time_type_select;
        $milestoneVals = $request->milestone_time_value;
        $i = 1;

        foreach ($taskNames as $key => $value) {

            $task = new Task;
           
            $task->taskflow_id              = $taskFlowId;
            $task->task_step_no             = $i;
            $task->designation_id           = $designations[$key];
            $task->task_name                = $taskNames[$key];
            $task->task_milestone_time_type = $milestoneTypes[$key];
            $task->task_milestone_time      = $milestoneVals[$key];

            $task->save();
            $i++;
        }
    }

    public function fecthTaskFlowsToDrawTbl(){
        
        $taskFlows = TaskFlow::with(['department'])->get();
        $data = array();
        
        foreach($taskFlows as $taskFlow){
            $d = array();
            $d['taskFlowDetails'] = array(
                'name'=> $taskFlow->task_flow_name,
                'code'=>$taskFlow->task_flow_code,
            );
            $d['department'] = $taskFlow->department->depart_name;
            $d['createdDetails'] =  array(
                'createdAt'=> $taskFlow->taskflow_created_at,
                'createdBy'=> User::getUsername($taskFlow->taskflow_cretaed_by),
            );
            $d['lastModifiesDetails'] =  array(
                'updatedAt'=> $taskFlow->taskflow_updated_at,
                'updatedBy'=> User::getUsername($taskFlow->taskflow_updated_by),
            );
            $d['status'] = $taskFlow->taskflow_status;
            $d['taskFlowId'] = $taskFlow->taskflow_id;
            array_push($data, $d);
        }

        $result = array(
			'data' => $data
		);
        
        return $result;
    }

    public function fetchTasksOfTaskFlow(){
        $taskflowId   = $_POST['taskflowId'];
        $taskflow = TaskFlow::with(['department'])->where('taskflow_id',$taskflowId)->get();
        $tasks = Task::with(['designation'])->where('taskflow_id',$taskflowId)->get();
        return array(
            'taskflow' => $taskflow,
            'tasks' => $tasks,
        );
    }

}
