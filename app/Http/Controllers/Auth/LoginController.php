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
        }else if($user->user_is_verified == 0){
            return back()->withErrors(['email' => 'User is not activated by the Admin.']);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_is_verified' => 1])) {
            $designationName = $user->designation->designation_name;
            $departmentName = $user->department->depart_name;

            $request->session()->regenerate();
            $request->session()->put([
                'designation'=> $designationName,
                'department'=> $departmentName ]);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

    }

}
