<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
 public function user_store(Request $request){
       $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|unique:users,email',
        'pan' => 'required|string|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
        'adhar' => 'required|string|regex:/^\d{12}$/',
        'address'=>'required'
       ]);
       if ($request->hasFile('profile')) {
        $name = 'pro' . '-' . time() . '-' . rand(0, 99) . '.' . $request->profile->extension();
        $request->profile->move(public_path('upload/profile'), $name);
}       
 $result=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'pan'=>$request->pan,
        'adhar'=>$request->adhar,
        'profile'=>$name,
        'address'=>$request->address,
       ]);
     if($result){
         Alert::success('Register successfully');
     }
     else{
        Alert::success('Something went wrong! please enter a valid details');
    }
     return redirect()->back();
 }
}
