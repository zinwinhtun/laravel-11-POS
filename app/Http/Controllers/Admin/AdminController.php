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
    public function adminDashboard(){
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

    //admin list
    public function adminlist(){
        $search = request('adminData');
        $searchableColumns = ['name','nickname', 'email', 'phone', 'address','provider'];

        $admin = User::when(request('adminData'),function($q) use ($search, $searchableColumns){
                            $q->where(function($query) use ($search,$searchableColumns){
                                foreach ($searchableColumns as $column) {
                                $query->orWhere($column, 'LIKE', '%' . $search . '%');
                                }
                            });
                        })->whereIn('role',['admin'])->latest()->get();
        return view('Admin.Template.Profile.adminList',compact('admin'));

    }

    //admin show
    public function view($id){
        $adminProfile = User::whereId($id)->first();
        $image = $this->getImage();
        return view('Admin.Template.Profile.admin-view',compact('adminProfile','image'));
    }

    //admin account
    public function delete($id){

        User::findOrFail($id)->delete();
        Alert::success('Delete Admin Account','You Delete Admin Account Successfully');
        return back();
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
        'name' => 'required|min:5|unique:users,name,' . $request->id,
        'nickname' => 'unique:users,name,' . $request->id,
        'email' => 'required|unique:users,email,'.$request->id,
        'phone' => 'required|numeric',
        'address' => 'required|max:50',
        'profile' => 'required|file|mimes:png,jpg,jpeg,svg,gif,webp',
        'password' => 'required|min:6',
        'confirm-password' => 'required|min:6|same:password'
       ];

       $rules['profile'] = $action == 'store' ? 'required|file|mimes:png,jpg,jpeg,svg,gif,webp': 'file|mimes:png,jpg,jpeg,svg,gif,webp';

       $request->validate($rules);
    }

    //CAll image path
    private function getImage(){
        $user = Auth::user();
         // Default image path
        $defaultImage = asset('/photo/default-user.jpg');

        // Determine the image source
        if ($user->profile) {
            // Check if it's a URL (social login)
            //FILTER_VALIDATE_URL is check variable have URL (http/https)
            if (filter_var($user->profile, FILTER_VALIDATE_URL)) {
                return $image = $user->profile;
            } else {
                // Otherwise, assume it's stored locally in storage
                return $image = asset('/photo/' . $user->profile);
            }
        } else {
            return $image = $defaultImage;
        }
    }
}
