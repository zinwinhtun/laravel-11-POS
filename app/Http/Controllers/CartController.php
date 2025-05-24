<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    //go to cart page
    public function cart(){
        $cartData = Cart::with('user:id','product:id,name,price,image')->where('user_id',Auth::user()->id)->get();
        //get total price at choose procuct
        $total = 0;
        foreach($cartData as $item){
            $total += $item->product->price * $item->qty;
        }

        return view('Client.Template.Cart.index',compact('cartData','total'));
    }

    //add to cart
    public function addToCart(Request $request){
        Cart::create($request->all());
        Alert::success('Add To Cart','Add Product to Cart Successfully');
        return to_route('client');
    }

    //delete cart
    public function cartDelete(Request $request){
        $cart_id = $request['cart_id'];
        Cart::whereId($cart_id)->delete();
        return response()->json(['status' => "success",'message' => "Cart Delete Success"],200);
    }
}
