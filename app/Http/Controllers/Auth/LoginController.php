<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(){
        
        return view('pages.auth.login');
    }

    public function authenticateUser(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email',  $request->email)->with(['department','designation'])->first();
        
        if(!$user){
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }else{
            //checking whether the user is Super Admin or not
            if($user->user_is_system_admin){
                if($this->checkSysAdminLoginAttempt($request)){
                    $this->setSysAdminSessionData($request);
                    return redirect()->intended('dashboard');
                }
                return back()->withErrors(['email' => 'The provided credentials do not match our records.',]);
                
            }else{
                if($user->user_is_verified == 0){
                    return back()->withErrors(['email' => 'Your account is not activated yet. Please contact the administrator']);
                }else{
                    if($this->checkLoginAttempt($request)) {
                        $this->setSessionData($request, $user);
                        return redirect()->intended('dashboard');
                    }
                    return back()->withErrors(['email' => 'The provided credentials do not match our records.',]);
                } 
            }
        }
    }

    private function checkLoginAttempt(Request $request){
        return (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_is_verified' => 1]));
    }

    private function checkSysAdminLoginAttempt(Request $request){
        return (Auth::attempt(['email' => $request->email, 'password' => $request->password]));
    }

    private function setSessionData(Request $request, $user){
        $designationName = $user->designation->designation_name;
        $departmentName = $user->department->depart_name;
        $userType = $user->getRoleNames()[0];

        $request->session()->regenerate();
        $request->session()->put([
            'designation'=> $designationName,
            'userType'=> $userType,
            'department'=> $departmentName ]);
    }

    private function setSysAdminSessionData(Request $request){
        $request->session()->regenerate();
        $request->session()->put([
            'designation'=> 'SysAdmin',
            'userType'=> 'SYSTEM-ADMIN',
            'department'=> 'SystemDev' ]);
    }

}
