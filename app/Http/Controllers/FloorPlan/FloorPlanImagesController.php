<?php

namespace App\Http\Controllers\FloorPlan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;

class FloorPlanImagesController extends Controller
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
        $img_exits = public_path() . '/asset/images/Maid/';
      
      $destinationPath = "asset/images/FloorImages";
       for($i =1 ; $i< Auth::user()->no_of_floors +1 ; $i++){  
        $find = DB::table('floorplan_images')->where('user_id','=',Auth::user()->id)->where('floor_no','=',$i)->first();
         if ($request->has("floor_$i")) {
       
            $file = $request->file("floor_$i");
           $img4_loccap = $file->getClientOriginalExtension();
            $filename = Auth::user()->name ."-floor-$i-" . strtotime(now()) . "." . $img4_loccap;
            $file->move($destinationPath, $filename);

           
        if($find){
            if (File::exists($img_exits . $find->image)) {
                File::delete($img_exits . $find->image);
            }
            DB::table('floorplan_images')->where('user_id','=',Auth::user()->id)->where('floor_no','=',$i)->update(array('image'=>$filename));
        }else{
             DB::table('floorplan_images')->insert(array('image'=>$filename,'floor_no'=>$i,'user_id'=>Auth::user()->id));
        }
        }else{
        if($find){
            DB::table('floorplan_images')->where('user_id','=',Auth::user()->id)->where('floor_no','=',$i)->update(array('image'=>""));
        }else{
        DB::table('floorplan_images')->insert(array('image'=>"",'floor_no'=>$i,'user_id'=>Auth::user()->id));
        }
    }
       }
     return redirect()->route('floor-plan.index');

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
        $img_exits = public_path() . '/asset/images/Maid/';
      
        $destinationPath = "asset/images/FloorImages";
          //
        $find = DB::table('floorplan_images')->where('id','=',$id)->first();
        if ($request->has("img")) {
      
           $file = $request->file("img");
          $img4_loccap = $file->getClientOriginalExtension();
           $filename = Auth::user()->name ."-floor-" . strtotime(now()) . "." . $img4_loccap;
           $file->move($destinationPath, $filename);

          
       if($find){
           if (File::exists($img_exits . $find->image)) {
               File::delete($img_exits . $find->image);
           }
          
       }
       DB::table('floorplan_images')->where('id','=',$id)->update(array('image'=>$filename));
    }
       return redirect()->route('floor-plan.index');
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
