<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function sign_up_form(){
        return view('Frontend.signup');
    }
       public function admin_login_form()
    {
        try{
            return view('frontend.signin');
        }
        catch(Exception $ex){
          session::flash('error','something went wrong');
        }
        return redirect()->back();
    }


    public function admin_login(Request $req)
    {
        $req->validate([
            'email'=>'required',
            'password'=>'required|min:8'
        ]);

        try {
            $user = Admin::where('email', $req->email)->first();
          // Find the user by email
            if ($user && Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password])) {
                Alert::success('Welcome'.Auth::guard('admin')->user()->name??'');
                return redirect()->route('admin.dashboard');
            } else {
                Alert::error('Invalid Credential !');
                return redirect()->back();
            }
        } catch (Exception $ex) {
            session()->flash('error', 'Invalid Credentials');
        }
        
        return redirect()->back();
    }


    public function logout()
{
    Auth::logout();     
    return redirect()->route('user_login_form'); 
}
}