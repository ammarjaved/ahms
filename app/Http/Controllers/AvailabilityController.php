<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvailabilityController extends Controller
{
    //


    public function index(){
       $users =  UserDetail::all('id');
       return response()->json(['data'=>$users,'status'=>200]);
    }



    public function update(){
        $rand = rand(1,5);

        

        DB::select("UPDATE personal_detail SET availability = 'available' WHERE id %$rand =0");

        $random = rand(3,5);
        DB::select("UPDATE personal_detail SET availability = 'unavailable' WHERE id %$random =0");

        return response()->json(['message'=>'update successfully','status'=>200]);
    }
}
