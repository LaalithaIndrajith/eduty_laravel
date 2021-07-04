<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserTypeController extends Controller
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

        $page_title = 'Create User Type';

        return view('pages.configurations.create_user_type', compact('page_title','page_breadcrumbs'));
    }

    public function createUserType(Request $request){
        try{
            Role::create(['name' =>  Str::upper($request->user_type_name)]);
            $userTypeCreation = [
                'msg' =>  'User Type Created Successfully',
                'title' => 'User Type Creation',
                'status' =>  1,
            ];

            $request->session()->flash('userTypeCreation', $userTypeCreation);

        }catch(Exception $e){
            $userTypeCreation = [
                'msg' =>  $e->getMessage(),
                'title' => 'User Type Creation is unsuccessful',
                'status' =>  0,
            ];

            $request->session()->flash('userTypeCreation', $userTypeCreation);
        }

        return redirect()->route('userTypeCreationView');
    }

    public function fetchUserTypesToDrawTbl(){
        $userTypes = Role::all();
        $data = array();
        foreach($userTypes as $userType){
            $d = array();
            $d['userTypeName'] = $userType->name;
            $d['createdAt']    = $userType->created_at;
            $d['updatedAt']    = $userType->updated_at;
            $d['id']           = $userType->id;
            array_push($data, $d);
        }

        return ['data' => $data];
      
    }
}
