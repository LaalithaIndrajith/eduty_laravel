<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Exception;
use App\Department;
use App\Designation;
use App\Events\userCreatedEvent;
use App\Events\userDetailsUpdatedEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Mail\userEdited;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
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
                'title' => 'Users',
                'page' => '#',
            ],
        ];

        $page_title = 'Create User';
        $page_description = 'Create a User Account';

        $data = [ 
            'departments' => Department::fetchAllDepartments(),
            'designations' => Designation::fetchAllDesignations(),
            'userTypes' => Role::where('name','!=', 'SYSTEM ADMIN')->get(),
        ];

        return view('pages.users.register_user', compact('page_title','page_breadcrumbs', 'data'));
    }

    public function registerUsers(Request $request){
        DB::beginTransaction();
        try{
            $this->validateRegisterUserForm($request);
            $user = new User;
            $this->saveUserDetailWithoutImg($user, $request);
            $this->userProfileImgSave($user, $request);
            $user->user_created_by = auth()->user()->id;
            $user->user_updated_by = auth()->user()->id;
            $user->save();
            $this->assignUserType($request,$user);
            DB::commit(); 
            
            //send mail using event & listeners    
            event(new userCreatedEvent($user));

            $userRegistration = [
                'msg' =>  'User Registered Successfully',
                'title' => 'User Registration',
                'status' =>  1,
            ];

            $request->session()->flash('userRegistration', $userRegistration);              
            
        }catch(Exception $e){
            DB::rollback();
            $userRegistration = [
                'msg' =>  'User Registration is unsuccessful',
                'title' => 'User Registration',
                'status' =>  0,
            ];

            $request->session()->flash('userRegistration', $userRegistration);  
        }
        return redirect()->route('userRegisterView');
    }

    public function editUser(Request $request,$userId){
        // dd($request->user_status);
        DB::beginTransaction();
        try{
            $this->validateEditUserForm($request,$userId);
            $user = User::find($userId);
            $this->saveEditUserDetailsWithoutImg($user, $request);
            $this->userProfileImgEdit($user, $request);
            $user->user_updated_by = auth()->user()->id;
            $user->save();
            $this->removeCurrentUserType($user);
            $this->assignUserType($request,$user);
            DB::commit();  
            
            //send mail using event & listeners    
            // event(new userDetailsUpdatedEvent($user));

            $userEdit = [
                'msg' =>  'User Details Updated Successfully',
                'title' => 'User Details',
                'status' =>  1,
            ];

            $request->session()->flash('userEdit', $userEdit);
            
        }catch(Exception $e){
            DB::rollback();
            $userEdit = [
                'msg' =>  'User Registration is unsuccessful',
                'title' => 'User Details',
                'status' =>  0,
            ];

            $request->session()->flash('userEdit', $userEdit);  
        }
        return redirect()->route('userEditView',$userId);
    }

    private function validateRegisterUserForm(Request $request){
        
        $request->validate([
            'department_select'  => 'required',
            'designation_select' => 'required',
            'user_title_select'  => 'required',
            'user_first_name'    => 'required|max:100',
            'user_last_name'     => 'required|max:100',
            'user_telephone'     => 'required',
            'user_address'       => 'required',
            'user_nic'           => 'required',
            'user_profile_image' => 'image|nullable',
            'user_name'          => 'required|max:100',
            'email'              => 'required|email|unique:users',
            'password'           => 'required|min:6|confirmed',
        ]);
    }
    
    private function validateEditUserForm(Request $request,$userId){
        
        $request->validate([
            'department_select'  => 'required',
            'designation_select' => 'required',
            'user_title_select'  => 'required',
            'user_first_name'    => 'required|max:100',
            'user_last_name'     => 'required|max:100',
            'user_telephone'     => 'required',
            'user_address'       => 'required',
            'user_nic'           => 'required',
            'user_profile_image' => 'image|nullable',
            'user_name'          => 'required|max:100',
            'email'              => 'required|email',
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
        if($request->user_status != null){
            $user->user_is_verified     = isset($request->user_status) ? 1 : 0;
        }
        $user->user_is_system_admin = ($request->user_type_select == 1) ? 1 : 0;
    }
    
    private function saveEditUserDetailsWithoutImg(User $user, Request $request)
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
        if($request->user_status != null){
        $user->user_is_verified     = isset($request->user_status) ? 1 : 0;
        }
        $user->user_is_system_admin = ($request->user_type_select == 1) ? 1 : 0;
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

    private function userProfileImgEdit(User $user, Request $request){
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
            
            $user->user_profile_image = $imageFileName;
        } 
    }

    // Assign User Types to the Users
    private function assignUserType(Request $request,$user){
        $userTypeId = $request->user_type_select;
        $userType = Role::findById($userTypeId);

        $user->assignRole($userType);

    }
    
    private function removeCurrentUserType($user){
        $currentUserType = $user->getRoleNames()[0];
        $user->removeRole($currentUserType);

    }
}
