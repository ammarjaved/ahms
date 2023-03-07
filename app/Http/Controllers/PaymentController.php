<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
 
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payments::all();
        $user=UserDetail::all();
        return view('Payments.index',['payments'=>$payments,'users'=>$user]);
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
        $request['personal_detail_id_fk'] = $request->id_fk;
        $request['created_by'] = Auth::user()->name;

     
        try{
      
        $app = Payments::create($request->all());

         }catch(Exception $e){
            return $e->getMessage();
            return redirect()->route('payment.index')->with('message','something is worng try again later');
        }
        return redirect()->route('payment.index');


    }


    public function genratePatments(Request $request){

        $month=date('m',strtotime($request->due_date));
        $year=date('Y',strtotime($request->due_date));
        $rs=DB::select("select count(*) from payments where month=$month and year=$year");
        if($rs>0){
            DB::select("delete from payments where month=$month and year=$year");
        }    
        $members=UserDetail::all();
        $issue_date=date('Y-m-d',strtotime($request->issue_date));
        $due_date=date('Y-m-d',strtotime($request->due_date));
        $username=Auth::user()->username;
        foreach($members as $member){
            $sql="INSERT INTO public.payments(
                  name, due_payment, created_by, created_at, due_date, personal_detail_id_fk,month,year)
                VALUES ('$member->name', '$member->rent_per_month', '$username',  '$issue_date', '$due_date', $member->id,$month,$year);";
        try{      
           DB::select($sql);     
        }catch(Exception $e){
            return $e->getMessage();
            return redirect()->route('payment.index')->with('message','something is worng try again later');
        }
        }
        return redirect()->route('payment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
        $payments = Payments::where('personal_detail_id_fk',$id)->get();

        return view('Payments.show',['payments'=>$payments]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $payments = Payments::find($id);
        return response()->json(['data'=>$payments,'status'=>200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        // return $request->all();
        try{
        Payments::find($request->id)->update($request->all());
        }catch(Exception $e){
            return redirect()->back()->with('message',"something is worng try agian later");
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payments  $payments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payments $payments)
    {
        //
    }
}
