<?php

namespace App\Http\Controllers;

use App\Models\BalanceModel;
use Exception;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
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

        try{
            $balance = BalanceModel::where('personal_detail_id_fk',$request->userID)->first();
            if($balance){
                $balance->update(['name_member'=>$request->name_member, 'balance'=>$request->balance , 'personal_detail_id_fk'=>$request->userID]);
            }else{

            
        BalanceModel::create(['name_member'=>$request->name_member, 'balance'=>$request->balance , 'personal_detail_id_fk'=>$request->userID]);
            }
        }catch(Exception $e){
            return $e->getMessage()
;            return redirect()->back()->with('message', "Something is worng try gain later");
        }

        return redirect()->route('user.index');
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
