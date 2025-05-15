<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    //client user ui show page
    public function clientUi(){
        return view('Client.Layout.master');
    }

    //user list in admin panel
    public function userList(){
        $search = request('user_data');
        $searchableColumns = ['name', 'nickname', 'email', 'phone', 'address', 'provider'];

        $user = User::when($search, function ($q) use ($search, $searchableColumns) {
            $q->where(function ($query) use ($search, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $search . '%');
                }
            });
        })->whereNotIn('role', ['admin', 'superadmin'])
            ->latest()
            ->get();

        return view('Admin.Template.User.index',compact('user'));
    }

    //show user information
    public function userView($id){
        $user = User::Where('id',$id)->first();
        return view('Admin.Template.User.show',compact('user'));
    }

    //user account delete
    public function userDelete($id){
        User::findOrFail($id)->delete();
        Alert::success('Delete User Account','You Delete User Account Successfully');
        return back();
    }

    //client side
    public function about(){
        return "this is about page";
    }

}
