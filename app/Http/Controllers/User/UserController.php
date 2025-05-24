<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    //client user ui show page
    public function clientUi(){
        //get sort name field from url // created_at is default
        $sortBy = request('sort_by','created_at');
        //get asc & desc sort value from url // desc is default
        $sortOrder = request('sort_order','desc');
        //get cart
        $cart = Cart::with('user:id')->where('user_id',Auth::user()->id)->get();
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
        return view('Client.Layout.master',compact('products','categories','cart'));
    }

    //product detail
    public function productDetail($id){
        $user = User::get();
        $product = Product::with('category')->findOrFail($id);
        $productList = Product::with('category')->get();
        $comment = Comment::with( 'product:id','user:id,name,nickname,profile')->where('product_id',$id)->latest()->get();
        $rating = number_format(Rating::where('product_id',$id)->avg('count'));  //get avarage count in rating tabel
        $userRating = number_format(Rating::where('product_id',$id)->where('user_id',Auth::user()->id)->value('count'));
        // dd($userRating);
        return view('Client.Template.Card.product-card',compact('product','productList','comment','rating','userRating'));
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

    //CAll image path
    private function getImage(){
        $user = Auth::user();
         // Default image path
        $defaultImage = asset('/photo/default-user.jpg');

        // Determine the image source
        if ($user->profile) {
            // Check if it's a URL (social login)
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
