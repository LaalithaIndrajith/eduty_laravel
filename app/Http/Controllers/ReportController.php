<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

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
}
