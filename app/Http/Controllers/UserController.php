<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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

    public function fecthUsersToDrawTbl(){
        
        $company_id = Auth::user()->comp_id;
        $users =User::with(['department','designation'])->get();
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
            $d['userType'] = 'System Admin';
            $d['status'] = $user->user_status;
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
}
