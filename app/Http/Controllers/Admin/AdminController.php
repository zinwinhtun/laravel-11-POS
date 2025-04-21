<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //admin index page
    public function dashboard(){
        return view('Admin.home.list');
    }
}
