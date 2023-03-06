<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {   
     
        $available  = UserDetail::where('availability','')->count();
        
       return view('dashboard',['avail'=>$available]);
    }
}

 