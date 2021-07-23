<?php

namespace App\Http\Controllers;

use App\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $userType = request()->session()->get('userType');
        if($userType == 'SYSTEM-ADMIN'){

            $page_breadcrumbs = [
                'main_module' =>  [   
                    'title' => 'Overview',
                    'page' => '#',
                ],
                'sub_module' =>  [   
                    'title' => 'Admin',
                    'page' => '#',
                ],
            ];
            $page_title = 'Dashboard';
            $page_description = 'Some description for the page';
    
            return view('pages.dashboards.dashboard_sys_admin', compact('page_title','page_breadcrumbs'));
        }else if($userType == 'ADMIN'){
            $page_breadcrumbs = [
                'main_module' =>  [   
                    'title' => 'Overview',
                    'page' => '#',
                ],
                'sub_module' =>  [   
                    'title' => 'Department Admin',
                    'page' => '#',
                ],
            ];

            $page_title = 'Dashboard';
            $page_description = 'Some description for the page';
    
            return view('pages.dashboards.dashboard_admin', compact('page_title','page_breadcrumbs'));
            
        }else if($userType == 'FRONT DESK'){
            $page_breadcrumbs = [
                'main_module' =>  [   
                    'title' => 'Overview',
                    'page' => '#',
                ],
                'sub_module' =>  [   
                    'title' => 'Front Desk Officer',
                    'page' => '#',
                ],
            ];

            $page_title = 'Dashboard';
            $page_description = 'Some description for the page';
    
            return view('pages.dashboards.dashboard_frontdesk', compact('page_title','page_breadcrumbs'));
        }else{
            $page_breadcrumbs = [
                'main_module' =>  [   
                    'title' => 'Overview',
                    'page' => '#',
                ],
                'sub_module' =>  [   
                    'title' => 'Front Desk Officer',
                    'page' => '#',
                ],
            ];

            $page_title = 'Dashboard';
            $page_description = 'Some description for the page';
    
            return view('pages.dashboards.dashboard_normal', compact('page_title','page_breadcrumbs'));
        }
    
    }

    /**
    * Dashboard Functions
    */

    //System Admin 
    public function getSysAdminDashDetails(){
        $totalActivatedUsers  = $this->getTotalActivateUsers();
        $totalActiveTaskflows = $this->getTotalActiveTaskflows();
        $mostPopularDetails   = $this->getMostNumOfJobDetails();

        return array(
            'totalActivatedUsers' => $totalActivatedUsers,
            'totalActiveTaskflows' => $totalActiveTaskflows,
            'mostPopularDetails' => $mostPopularDetails,
        );
    }

    private function getTotalActivateUsers(){
        return DB::table('users')
        ->where('user_is_verified', 1)
        ->where('user_is_system_admin',0)
        ->count();
    }

    private function getTotalActiveTaskflows(){
        return DB::table('taskflows')
        ->where('taskflow_status',1)
        ->count();
    }

    private function getMostNumOfJobDetails(){
        $now   = Carbon::now();
        $today = $now->format('Y-m-d 23:59:59');
        $lastweek = $now->subDays(7)->format('Y-m-d 23:59:59');

        $mostNumJobDep = DB::table('clients_has_taskflows')
        ->join('taskflows', 'clients_has_taskflows.taskflow_id', '=', 'taskflows.taskflow_id')
        ->where('clients_has_taskflows.job_allocation_created_at','<=',$today)
        ->where('clients_has_taskflows.job_allocation_created_at','>',$lastweek)
        ->select('taskflows.depart_id', DB::raw('count(*) as total'))
        ->groupBy('taskflows.depart_id')
        ->orderBy('total','desc')
        ->get();

        $mostPopularTaskflows = DB::table('clients_has_taskflows')
        ->join('taskflows', 'clients_has_taskflows.taskflow_id', '=', 'taskflows.taskflow_id')
        ->where('clients_has_taskflows.job_allocation_created_at','<=',$today)
        ->where('clients_has_taskflows.job_allocation_created_at','>',$lastweek)
        ->select('taskflows.task_flow_name', DB::raw('count(*) as total'))
        ->groupBy('taskflows.task_flow_name')
        ->orderBy('total','desc')
        ->get();

        $mostNumjoBDepArranged = $this->arrangeMostNumOfjObDep($mostNumJobDep);
        $mostPopularTaskfArranged = $this->arrangeMostPopularTaskflow($mostPopularTaskflows);
        
        return array(
            'mostPopularDep' => $mostNumjoBDepArranged,
            'mostPopularDTaskflow' => $mostPopularTaskfArranged,
        );
        
    }
    
    private function arrangeMostNumOfjObDep($mostNumJobDep){
        $maxNum     = 0;
        $depIdArr   = array();
        $depNameArr = array();
        foreach($mostNumJobDep as $el){
            if($maxNum < $el->total){
                $maxNum = $el->total;
                array_push($depIdArr,$el->depart_id);
            }else if($maxNum ==$el->total){
                array_push($depIdArr,$el->depart_id);
            }
        }

        foreach($depIdArr as $depId){
            $depname = Department::getDepName($depId);
            array_push($depNameArr,$depname);
        }

        return array(
            'depName' => $depNameArr,
            'total' => $maxNum,
        );
    }

    private function arrangeMostPopularTaskflow($mostPopularTaskfArr){
        $maxNum   = 0;
        $taskfArr = array();
        foreach($mostPopularTaskfArr as $el){
            if($maxNum < $el->total){
                $maxNum = $el->total;
                array_push($taskfArr,$el->task_flow_name);
            }else if($maxNum ==$el->total){
                array_push($taskfArr,$el->task_flow_name);
            }
        }

        return array(
            'taskflowArr' => $taskfArr,
            'total' => $maxNum,
        );
    }

    public function getSysAdminDoughnutChartData(){
        $now   = Carbon::now();
        $today = $now->format('Y-m-d 23:59:59');
        $lastweek = $now->subDays(7)->format('Y-m-d 23:59:59');
        $pending = DB::table('clients_has_taskflows')

        ->where('job_ticket_status','ISSUED')
        ->where('job_allocation_created_at','<=',$today)
        ->where('job_allocation_created_at','>',$lastweek)
        ->count();

        $ongoing = DB::table('clients_has_taskflows')
        ->where('job_ticket_status','ONG')
        ->where('job_allocation_created_at','<=',$today)
        ->where('job_allocation_created_at','>',$lastweek)
        ->count();

        $rejected = DB::table('clients_has_taskflows')
        ->where('job_ticket_status','REJECT')
        ->where('job_allocation_created_at','<=',$today)
        ->where('job_allocation_created_at','>',$lastweek)
        ->count();

        $completed = DB::table('clients_has_taskflows')
        ->where('job_ticket_status','COMP')
        ->where('job_allocation_created_at','<=',$today)
        ->where('job_allocation_created_at','>',$lastweek)
        ->count();

        return array($pending,$ongoing,$rejected,$completed);
    }

}
