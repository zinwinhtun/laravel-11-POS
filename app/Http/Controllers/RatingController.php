<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RatingController extends Controller
{
    //set rating
    public function setRate(Request $request){
        Rating::updateOrCreate([
            //create stage
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id
        ],[
            //update stage
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'count' => $request->count
        ]);
        // dd($request->count);
        Alert::success('Rating','You give a rated successfully');
        return back();
    }
}
