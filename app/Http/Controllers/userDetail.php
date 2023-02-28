<?php

namespace App\Http\Controllers;

use App\Models\roomInfo;
use App\Models\UserDetail as user;
use App\Models\work_info;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
       

        // $users =  DB::table('personal_detail')
        // ->join('work_info', 'personal_detail.id', '=', 'work_info.pd_id')
        // ->join('room_info', 'personal_detail.id', '=', 'room_info.pd_id')
        // ->select('*')
        // ->get();


        $data = [] ;
         $user = user::find($id);
         if(!$user)
         {
            return abort('404');
         }
         $data['user'] = $user;
         $data['work_info'] = work_info::where('pd_id' , $user->id)->first();
         $data['room_info'] = roomInfo::where('pd_id',$user->id)->first();

            //   return $data;
       // $users = user::find($id);
        return view('layouts.personal',['data'=>$data]);
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
                $request['user_image']  =   '/asset/images/Users/'. $filename;
            }

            if($request->id == ''){
            $request['created_by']  =   Auth::user()->name;

            $userDetail             =   user::create($request->all());

            $request['pd_id']       =   $userDetail->id;
            

            $roomInfor              =   roomInfo::create($request->all());
            $workInfor              =   work_info::create($request->all());

            }
                else{
                    $userDetail             =   user::find($request->id)->update($request->all());
                    $request['pd_id']       =   $userDetail->id;
                    $roomInfor              =   roomInfo::where('pd_id',$request->id)->update($request->all());
                    $workInfor              =   work_info::where('pd_id',$request->id)->update($request->all());
                }


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
    public function show($id)
    {
        $data = [] ;
         $user = user::find($id);
         if(!$user)
         {
            return response()->json(['data'=>'','status'=>'404']);
         }
         $data['user'] = $user;
         $data['work_info'] = work_info::where('pd_id' , $user->id)->first();
         $data['room_info'] = roomInfo::where('pd_id',$user->id)->first();

         return response()->json(['data'=>$data,'status'=>'200']);
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
