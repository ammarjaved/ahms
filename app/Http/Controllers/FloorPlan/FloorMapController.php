<?php

namespace App\Http\Controllers\FloorPlan;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FloorMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $id = Auth::user()->id;
        $floor = DB::select("select * from floorplan_images where user_id = $id and image != '' order by floor_no asc");
        // return $this->show( $floor[0]->floor_no);
        return response()->json(['status' => 200, 'data' => $floor]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aid = Auth::user()->id;
        $geom = DB::select("SELECT json_build_object(
            'type', 'FeatureCollection',
            'crs', json_build_object(
                     'type', 'name',
                     'properties', json_build_object('name', 'EPSG:4326')
                   ),
            'features', json_agg(
                          json_build_object(
                            'type', 'Feature',
                            'id', id,
                            'geometry', ST_AsGeoJSON(geom)::json,
                            'properties', json_build_object(
                                            'id',id,
                                            'floor_no', floor_no,
                                            'name', name,
                                            'gender', gender,
                                            'availability', availability,
                                            'room_no', room_no,
                                            'bed_no',bed_no,
                                            'last_name',last_name
                                          )
                          )
                      )
          ) AS geojson
          FROM (
            SELECT b.id,  a.floor_no, a.geom, b.name, b.gender, b.availability, b.last_name,c.room_no, c.bed_no
            FROM member_beds_geoms a
            JOIN personal_detail b ON a.member_id = b.id
            JOIN room_info c ON a.member_id = c.pd_id
            WHERE a.floor_no = '$id' and user_id = $aid
          ) AS tbl1;
          ");
        return response()->json(['status'=>200,'data'=>$geom]);
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

    public function getMemberDetail($id)
    {
     
       $user = DB::table('personal_detail AS pd')
       ->where('pd.id', $id)
       ->join('room_info AS ri', 'pd.id', '=', 'ri.pd_id')
       ->select('pd.*', 'ri.*')
       ->first();
       
       return response()->json(['status'=>200,'data'=>$user]);
    }
}
