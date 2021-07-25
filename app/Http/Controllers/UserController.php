<?php

namespace App\Http\Controllers;

use App\User;
use App\Department;
use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
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
        
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Masters',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'User Management',
                'page' => '#',
            ],
        ];

        $page_title = 'User List';

        return view('pages.users.user_list', compact('page_title','page_breadcrumbs'));
    }

    public function viewUserForEdit($userId){
        $user = User::find($userId);
        $userTypeId = $this->findUserTypeId($user);
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Masters',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Users',
                'page' => '#',
            ],
        ];

        $page_title = 'Edit User';
        $page_description = 'Edit a User Account';

        $data = [ 
            'departments' => Department::fetchAllDepartments(),
            'designations' => Designation::fetchAllDesignations(),
            'userTypeId' => $userTypeId,
            'userTypes' => Role::where('name','!=', 'SYSTEM ADMIN')->get(),
        ];

        return view('pages.users.edit_user', compact('page_title','page_breadcrumbs', 'data', 'user'));
    }

    public function fecthUsersToDrawTbl(){
        
        if(auth()->user()->userType != 'SYSTEM-ADMIN'){
            $users = User::with(['department','designation'])
            ->where('user_is_system_admin','!=',1)
            ->where('depart_id',auth()->user()->depart_id)
            ->get();
        }else{
            $users = User::with(['department','designation'])->where('user_is_system_admin','!=',1)->get();
        }
        $data = array();
        
        foreach($users as $user){
            $d = array();
            $d['user'] = array(
                'name'=>$user->user_fname.' '.$user->user_lname,
                'email'=>$user->email,
                'image'=>$user->user_profile_image,
            );
            $d['desigDetails'] = array(
                'desigName'=> $user->designation->designation_name,
                'desigCode'=>$user->designation->designation_code,
            );
            $d['department'] = $user->department->depart_name;
            $d['createdDetails'] =  array(
                'createdAt'=> $user->user_created_at,
                'createdBy'=> $this->getUsername($user->user_created_by),
            );
            $d['lastModifiesDetails'] =  array(
                'updatedAt'=> $user->user_updated_at,
                'updatedBy'=> $this->getUsername($user->user_updated_by),
            );
            $d['userType'] = $user->getRoleNames();
            $d['status'] = $user->user_is_verified;
            $d['userId'] = $user->id;
            array_push($data, $d);
        }

        $result = array(
			'data' => $data
		);
        return $result;
    }

    private function getUsername($userId){

        $username = DB::table('users')->where('id',$userId)->value('username');
        return $username;

    }

    private function findUserTypeId($user){
        $currentUserType = $user->getRoleNames()[0];
        $userTypeId = DB::table('roles')->where('name',$currentUserType)->value('id');
        return $userTypeId;
    }

    
}
