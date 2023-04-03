<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssignRoomController extends Controller
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
        //
        try{
        $id = Auth::user()->id;
        // DB::table('member_beds_geoms')->insert(array('member_id'=>$request->member_id,'floor_no'=>$request->floorNo,'user_id'=>Auth::user()->id,'geom'=>st_geomfromtext('POINT('||$request->lng||' '||$request->lat||')',4326)));
        DB::select("INSERT INTO member_beds_geoms (member_id, user_id, floor_no,geom) VALUES($request->member_id ,$id ,$request->floorNo , st_geomfromtext('POINT('|| CAST($request->lng as text)  ||' '||CAST($request->lat as text) ||')',4326))");
        UserDetail::find($request->member_id)->update(['room_status',true]);
        }
        catch(Exception $e){
            return redirect()->route('floor-plan.index')->with('error', 'Something is worng try again later');
        }
        return redirect()->route('floor-plan.index')->with('message','Room Assigned');
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
