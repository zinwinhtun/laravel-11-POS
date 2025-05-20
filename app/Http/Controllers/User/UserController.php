<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    //client user ui show page
    public function clientUi(){
        //get sort name field from url // created_at is default
        $sortBy = request('sort_by','created_at');
        //get asc & desc sort value from url // desc is default
        $sortOrder = request('sort_order','desc');
        $categories = Category::get();
        $products = Product::with('category')
                    // filter with category name
                    ->when(request('categoryId'),function($q){
                        $q->where('category_id',request('categoryId'));
                    })
                    // search with product name
                    ->when(request('searchProduct'),function($query){
                        $query->where('name','like','%'.request('searchProduct').'%');
                    })
                    //sort data by name price date
                    ->orderBy($sortBy,$sortOrder)->paginate(8)->withQueryString();
        return view('Client.Layout.master',compact('products','categories'));
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
