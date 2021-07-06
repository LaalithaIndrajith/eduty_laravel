<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(){
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Configurations',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Access & Permissions',
                'page' => '#',
            ],
        ];

        $page_title = 'Create Access Controller';

        return view('pages.configurations.access_control.create_access_controller', compact('page_title','page_breadcrumbs'));
    }
}
