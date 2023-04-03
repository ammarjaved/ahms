<?php

namespace App\Http\Controllers\FloorPlan;

use App\Http\Controllers\Controller;
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
        $geom = DB::select("SELECT json_build_object('type', 'FeatureCollection','crs',  json_build_object('type','name', 'properties', json_build_object('name', 'EPSG:4326'  )),'features', json_agg(json_build_object('type','Feature','id',id,'geometry',ST_AsGeoJSON(geom)::json,
        'properties', json_build_object(
        'user_id', user_id,
        'floor_no',floor_no,
        'name',name,
        'current_address',current_address,	
        'gender',gender,
            'age',age,
            'phone_no',phone_no,
            'emergency_no',emergency_no,
            'relegion',relegion,
            'nationality',nationality,
            'visa',visa,
            'created_by',created_by,
            'passport_expiry',passport_expiry,
            'visa_expiry',visa_expiry,
            'user_image',user_image,
            'availability',availability,
            'rent_per_month',rent_per_month,
            'date_of_birth',date_of_birth,
            'license_plate',license_plate,
            'hire_date',hire_date,
            'email',email,
            'room_status',room_status 
    )))) as geojson
    FROM (select a.id , user_id, floor_no,geom,b.name,b.current_address,b.gender, b.age, b.phone_no,
b.emergency_no, b.relegion, b.nationality, b.passport_no, b.visa, b.created_by, b.passport_expiry,
b.visa_expiry, b.user_image, b.availability, b.rent_per_month, b.date_of_birth, b.license_plate,
b.hire_date, b.last_name, b.email, b.room_status from member_beds_geoms a,personal_detail b
          where a.floor_no = '1' and a.member_id=b.id ) as tbl1");
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
}
