<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Department;
use App\Designation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
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

        $page_title = 'Create User';
        $page_description = 'Create a User Account';

        $data = [ 
            'departments' => Department::fetchAllDepartments(),
            'designations' => Designation::fetchAllDesignations(),
        ];

        return view('pages.users.register_user', compact('page_title','page_breadcrumbs', 'data'));
    }

    public function registerUsers(Request $request){

        try{
            $this->validateRegisterUserForm($request);
            $user = new User;
            $this->saveUserDetailWithoutImg($user, $request);
            $this->userProfileImgSave($user, $request);
            $user->save();
            
            return redirect()->route('userRegisterView');
            
        }catch(Exception $e){

        }
    }

    private function validateRegisterUserForm(Request $request){
        
        $request->validate([
            'department_select'  => 'required',
            'designation_select' => 'required',
            'user_title_select'  => 'required',
            'user_first_name'    => 'required|max:100',
            'user_last_name'     => 'required|max:100',
            'user_telephone'     => 'required',
            'user_telephone'     => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:10|max:10',
            'user_address'       => 'required',
            'user_nic'           => 'required',
            'user_profile_image' => 'image|nullable',
            'user_name'          => 'required|max:100',
            'email'              => 'required|email|unique:users',
            'password'           => 'required|min:6|confirmed',
        ]);
    }

    private function saveUserDetailWithoutImg(User $user, Request $request)
    {
        $user->depart_id            = $request->department_select;
        $user->designation_id       = $request->designation_select;
        $user->user_title           = $request->user_title_select;
        $user->user_fname           = Str::upper($request->user_first_name);
        $user->user_lname           = Str::upper($request->user_last_name);
        $user->user_telephone       = $request->user_telephone;
        $user->user_address         = Str::upper($request->user_address);
        $user->user_nic             = Str::upper($request->user_nic);
        $user->username             = Str::upper($request->user_name);
        $user->email                = Str::lower($request->email);
        $user->password             = Hash::make($request->password);
        $user->user_is_verified     = isset($request->user_status) ? 1 : 0;
        $user->user_is_system_admin = 0;
    }

    private function userProfileImgSave( User $user, Request $request){
        
        if ($request->hasFile('user_profile_image')) {
            // Get filename with the extension
            $imagefilenameWithExt = $request->file('user_profile_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($imagefilenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('user_profile_image')->getClientOriginalExtension();
            // Filename to store
            $imageFileName = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('user_profile_image')->storeAs('public/images/user_porfile_images', $imageFileName);
        } else {
            $imageFileName = 'no_image.jpg';
        }

        $user->user_profile_image = $imageFileName;
    }
}
