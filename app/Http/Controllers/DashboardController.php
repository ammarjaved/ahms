<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {   
        $data = [];
        $data['available']  = UserDetail::where('availability','available')->count();
        $data['resident']  = UserDetail::all()->count();
        
       return view('dashboard',['data'=>$data]);
    }
}

 