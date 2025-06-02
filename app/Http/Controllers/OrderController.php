<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment_History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    //

    //store Order
    public function order(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|min:11',
            'payment_methods' => 'required',
            'pay_slip' => 'required|file|mimes:png,jpg,jpeg,webp,svg,gif',
            'address' => 'required',
            'orderCode' => 'required',
            'total_amount' => 'required'
        ]);
        //get payment history data
        $paymentHistory = [
            'user_name' => Auth::user()->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->payment_methods,
            'order_code' => $request->orderCode,
            'total_amount' => $request->total_amount
        ];
        //get add to cart data
        $order = Session::get('temp');
        //get pay_slip image
        if($request->hasFile('pay_slip')){
            $fileName = uniqid().'-'.$request->file('pay_slip')->getClientOriginalName();
            $request->file('pay_slip')->move(public_path().'/payment-slip/' , $fileName);
            $paymentHistory['pay_slip'] = $fileName;
        }

        Payment_History::create($paymentHistory);

        foreach($order as $item){
            Order::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'count' => $item['count'],
                'status' => $item['status'],
                'order_code' => $item['order_code'],
            ]);

            Cart::where('user_id',$item['user_id'])->where('product_id',$item['product_id'])->delete();
        }

        Alert::success('Order Success.','Thank for your order.');
        return to_route('cart.index');
    }


}
