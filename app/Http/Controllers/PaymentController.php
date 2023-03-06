<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use Exception;
use Illuminate\Support\Facades\Auth;

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
