<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    //user give a comment
    public function commentCreate(Request $request){
        Comment::create($request->all());
        Alert::success('Give Review','You gived a review successfully...');
        return back();
    }

    // delete comment only self
    public function delete($id){
        Comment::whereId($id)->delete($id);
        return back();
    }
}
