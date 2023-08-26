<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.users.add_user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $userlist=User::all();
      return view('backend.users.view_user',compact('userlist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decrypt($id);
        $useredit=User::find($id);
        $users=User::all();
        return view('backend.users.add_user',compact('users','useredit'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'pan' => 'required|string|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
            'adhar' => 'required|string|regex:/^\d{12}$/',
            'address'=>'required'
           ]);

        $id = Crypt::decrypt($id);
        if ($request->hasFile('prfile')) {
            $name = 'pro' . '-' . time() . '-' . rand(0, 99) . '.' . $request->prfile->extension();
            $request->prfile->move(public_path('upload/profile'), $name);
            User::find($id)->update(['profile'=>$name]);
          }
        $res=User::find($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'pan'=>$request->pan,
            'adhar'=>$request->adhar,
            'address'=>$request->address,
        ]);
        if ($res) {
            Alert::success('User Updated successfully');
        } else {
            Alert::error('User not update!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $id = Crypt::decrypt($id);
        $data = User::find($id);
        if ($data->delete()) {
            Alert::success('Data Deleted successfully.');
        } else {
            Alert::error('Data not deleted.');
        }
        return redirect()->back();
    }
}
