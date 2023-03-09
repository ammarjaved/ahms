<?php

namespace App\Http\Controllers;

use App\Models\BalanceModel;
use App\Models\UserDetail;
use App\Models\UtilityModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Goto_;
use Symfony\Component\HttpFoundation\Session\Session;

class UtilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user = DB::table('personal_detail')->leftJoin('member_account','member_account.personal_detail_id_fk','=','personal_detail.id') ->select('personal_detail.*', 'member_account.balance','member_account.updated_at')->get();
        $utility =  DB::table('personal_detail')->join('utility_usage', 'utility_usage.pd_id','personal_detail.id')->join('utility','utility.id','utility_usage.utility_id')->get();
    // return $user;
        return view('Utility.index',['users'=>$user,'utility'=>$utility]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       try
       {

        $user = BalanceModel::where('personal_detail_id_fk' , $request->user)->first();
        if(!$user){
            return redirect()->back()->with('message','Insufficient Balance !!!');
        }

 

       $ut =  DB::table('utility')->where('utility_name', 'gas')->first();
    //    return $ut->id;
        $charge = $request->total_time_in_min * $ut->charges_per_min;
        // return $charge;
        $sum = $user->balance - $charge;
         
      
        if ($sum <  0 ){

            return redirect()->back()->with('message','Insufficient Balance !!!');
        }
        BalanceModel::where('personal_detail_id_fk' , $request->user)->update(['balance'=>$sum]);
        UtilityModel::create([
            'pd_id'=>$request->user,
            'utility_id'=>$ut->id,
            'on_time'=>$request->on_time,
            'off_time'=>$request->off_time,
            'total_time_in_min'=>$request->total_time_in_min,
            'charges'=>$charge
        ]);
    }catch (Exception $e){
        return redirect()->back()->with('message','Something is worng !!!');
    }
    return redirect()->back()->with('message','Update Successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
