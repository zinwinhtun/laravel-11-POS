<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment_History;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    //client order history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->groupBy('order_code')->latest()->get();
        // dd($order->toArray());
        return view('Client.Template.Order.index',compact('order'));
    }

    //admin order list
    public function AdminOrderList (){
        $order = Order::with('user:id,name','product')->when(request('searchKey'),function($query){
            $search = request('searchKey');
            $query->where('order_code','like','%'.$search.'%')
                // Search in user table
                ->orWhereHas('user',function($q) use ($search){
                $q->where('name','like','%'.$search.'%');
            });
        })->groupBy('order_code')->latest()->get();
         return view('Admin.Template.Order.list',compact('order'));
    }
    //Admin Sale History
    public function ConfirmSale(){
        $confirmOrder = Order::where('status','=',1)->groupBy('order_code')->get();
        return view('Admin.Template.Order.orderConfirm',compact('confirmOrder'));
    }

    //admin order detail
    public function AdminOrderDetail($order_code){
        $order = Order::with('product')->where('order_code',$order_code)->get();
        $paymentHistory = Payment_History::where('order_code',$order_code)->first();
        // checking whish  product is out of stock in order than this order cannot be accept
        $outOfStock = true;
        foreach($order as $item){
            if($item->count >= $item->product->stock){
                $outOfStock = false;
                break;
            }
        }
        return view('Admin.Template.Order.Detail',compact('order','paymentHistory','outOfStock'));
    }

    //admin order status change with api
    public function statusChange(Request $request){
        Order::where('order_code',$request->order_code)->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Change Order Status Success'
        ],200);
    }

    //admin order API reject
    public function orderReject(Request $request){
        Order::where('order_code',$request->order_code)->update([
            'status' => 2
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Order Rejected'
        ],200);
    }

    //admin order API accept
    public function orderAccept(Request $request){
        Order::where('order_code',$request[0]['order_code'])->update([
            'status' => 1
        ]);

        //reduce stock when order accept
        foreach($request->all() as $item){
            Product::where('id',$item['product_id'])->decrement('stock',$item['count']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order Rejected'
        ],200);
    }

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
