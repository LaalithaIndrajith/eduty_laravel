<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
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

        return view('pages.dashboards.dashboard_admin', compact('page_title','page_breadcrumbs'));
    }
}
