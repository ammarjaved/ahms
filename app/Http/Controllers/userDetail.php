<?php

namespace App\Http\Controllers;

use App\Models\roomInfo;
use App\Models\UserDetail as user;
use App\Models\work_info;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class userDetail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = user::all();
        return view('User-Details.index',['users'=>$users]);
    }


    public function personal($id)
    {

       // $users = user::find($id);
        return view('layouts.personal');
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
        // return $request->all();
        $destinationPath        =   'asset/images/Users';
        try{

            if($request->userImage != ""){
                $file                   =   $request->file('userImage');                
                $img4_loccap            =   $file->getClientOriginalExtension() ;
                $filename               =  'User-'.$request->name.'-'.  strtotime(now()) .'.' . $img4_loccap;
                                            $file->move($destinationPath, $filename);
                $request['user_image']  =   public_path().'asset/images/Users'. $img4_loccap;
            }
            
            $userDetail             =   user::create($request->all());

            $request['pd_id']       =   $userDetail->id;
            $request['created_by']  =   Auth::user()->name;

            $roomInfor              =   roomInfo::create($request->all());
            $workInfor              =   work_info::create($request->all());

        }
        catch (Exception $e){
           return  redirect()->route('user.index')->with('message','Something is worng try again later');
        }
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show(UserDetail $userDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDetail $userDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDetail $userDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        // return $id;
        $userDetail = user::find($id);
        if($userDetail){

            $workInfo =  work_info::where('pd_id',$userDetail->id);
            if($workInfo){
                $workInfo->delete();
            }

            $roomInfo = roomInfo::where('pd_id',$userDetail->id);
            if($roomInfo){
                $workInfo->delete();
            }
            $userDetail->delete();
        }
        // return
       return redirect()->route('user.index');
    }
}
