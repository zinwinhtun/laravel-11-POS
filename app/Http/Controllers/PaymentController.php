<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get payment methods enum data
        $methods = Payment::payment_methods();
        // Get selected method from dropdown
        $selectMethod = request()->input('methods');
        //make query
        $paymentsQuary = Payment::query();
        // Apply method filter if selected
        if($selectMethod){
            $paymentsQuary->where('payment_methods',$selectMethod);
        }
        $payments = $paymentsQuary->when(request('searchData'),function($q){
                        $search = request('searchData');
                        $q->where('account_name', 'like', '%' . $search . '%')
                        ->orWhere('account_number','like','%'.$search. '%' )
                        ->orWhere('payment_methods','like','%' . $search . '%');
                    })->latest()->get();


        return view('Admin.Template.Payment.index',compact('methods','payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->dataValidation($request);
        // dd($request->toArray());
        Payment::create($request->all());
        Alert::success('Create','Payment Account Created Successful');
        return to_route('payment.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->dataValidation($request,$id);
        $payments = Payment::get();
        $methods = Payment::payment_methods();
        Payment::FindOrFail($id)->update($request->all());
        Alert::success('Updated','Payment Account Updated Successful');
        return to_route('payment.index',compact('payments','methods'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payment::findOrFail($id)->delete();
        Alert::success('Deleted','Payment Account Deleted Successful');
        return back();
    }

    private function dataValidation($request){
        $request->validate([
            'account_name' => 'required'. $request->id,
            'account_number' => 'required'. $request->id,
            'payment_methods' => 'required|not_in:0'
        ]);
    }

}
