<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

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
        dd($request);
    }
}
