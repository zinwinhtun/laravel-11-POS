<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    //admin index page
    public function dashboard(){
        return view('Admin.home.dashboard');
    }

    // admin account create
    public function adminCreate(){
        $user = Auth::user();
        return view('Admin.Template.Profile.admin-create',compact('user'));
    }

    //admin account store
    public function store(Request $request){
        $this->adminValidationCheck($request,'store');
        $data = $this->getData($request);
        //image store
        if($request->hasFile('profile')){
            $fileName = uniqid() .$request->file('profile')->getClientOriginalName();
            $request->file('profile')->move(public_path().'/photo/' , $fileName);
            $data['profile'] = $fileName;
        }

        User::create($data);
        Alert::success('Admin Account Create', 'Success Admin Account Creation');
        return to_route('profile.index');
    }

    //show admin list
    public function adminlist(){
        dd('admin list');

    }
    //get admin account data
    private function getData($request){
        return [
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'admin',
            'profile' => $request->profile,
            'password' => Hash::make($request->password)
        ];
    }


    //admin data validation
    private function adminValidationCheck($request,$action){
       $rules = [
        'name' => 'required|min:5|max:10|unique:users,name,' . $request->id,
        'nickname' => 'unique:users,name,' . $request->id,
        'email' => 'required|unique:users,email,'.$request->id,
        'phone' => 'required|numeric',
        'address' => 'required|max:50',
        'profile' => 'required|file|mimes:png,jpg,jpeg,svg,gif',
        'password' => 'required|min:6',
        'confirm-password' => 'required|min:6|same:password'
       ];

       $rules['profile'] = $action == 'store' ? 'required|file|mimes:png,jpg,jpeg,svg,gif': 'file|mimes:png,jpg,jpeg,svg,gif';

       $request->validate($rules);
    }
}
