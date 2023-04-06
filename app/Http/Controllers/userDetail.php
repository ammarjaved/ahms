<?php

namespace App\Http\Controllers;

use App\Models\BalanceModel;
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
        return view('User-Details.index', ['users' => $users]);
    }

    public function personal($id)
    {
        // $users =  DB::table('personal_detail')
        // ->join('work_info', 'personal_detail.id', '=', 'work_info.pd_id')
        // ->join('room_info', 'personal_detail.id', '=', 'room_info.pd_id')
        // ->select('*')
        // ->get();

        $data = [];
        $user = user::find($id);
        if (!$user) {
            return abort('404');
        }
        $data['user'] = $user;
        $data['work_info'] = work_info::where('pd_id', $user->id)->first();
        $data['room_info'] = roomInfo::where('pd_id', $user->id)->first();
        $data['balance'] = BalanceModel::where('personal_detail_id_fk', $user->id)->first();
        // if(!$data['balance']){
        //     $data['balance']['balance'] = "0";
        //     $data['balance']['updated_at'] = "00-00-0000";
        // }

        //   return $data;
        // $users = user::find($id);
        return view('layouts.personal', ['data' => $data]);
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
        // return $request->userImage_base64;
        
        // return;
        // $this->apiCreate($request);

        // return 'sdfgsdf';
        //
        // return $request->all();
        $destinationPath = 'asset/images/Users';
        try {
            if ($request->userImage != '') {
                $file = $request->file('userImage');
                $img4_loccap = $file->getClientOriginalExtension();
                $filename = 'User-' . $request->name . '-' . strtotime(now()) . '.' . $img4_loccap;
                $file->move($destinationPath, $filename);
                $request['user_image'] = '/asset/images/Users/' . $filename;
            }
$id = "";
            if ($request->id == '') {
                $request['created_by'] = Auth::user()->name;
                $request['room_status'] = false;

                $userDetail = user::create($request->all());
               
                $request['pd_id'] = $userDetail->id;
                $id = $userDetail->id;
                $roomInfor = roomInfo::create($request->all());
                $workInfor = work_info::create($request->all());
            } else {
                $id = $request->id;
                $userDetail = user::find($request->id)->update($request->all());

                

                $workInfor = work_info::where('pd_id', $request->id)->update(['company' => $request->company, 'work_address' => $request->work_address, 'work_contact' => $request->work_contact, 'person_incharge' => $request->person_incharge]);

                $roomInfor = roomInfo::where('pd_id', $request->id)->update(['floor' => $request->floor, 'room_no' => $request->room_no, 'bed_no' => $request->bed_no]);


            }



            $data = "{\"pin\": \"$id\",
                \n\"deptCode\": \"1\",
                \n\"name\": \"$request->name\",
                \n\"lastName\": \"$request->last_name\",
                \n\"gender\": \"$request->gender\",
                \n\"birthday\": \"$request->date_of_birth\",
                \n\"carPlate\": \"$request->license_plate\",
                \n\"isDisabled\": false,
                \n\"isSendMail\": false,
               
               
                \n\"ssn\": \"111111\",
                
                \n\"email\": \"$request->email\",
               \n\"accEndTime\": \"2019-07-14 08:56:00\",
               \n\"accStartTime\": \"2018-07-14 08:56:00\",
               \n\"mobilePhone\": \"$request->phone_no\",
               \n\"hireDate\": \"$request->hire_date\",
             
                \n\"accLevelIds\": \"access level group ids\"\n}";
    //   \n\"personPhoto\": \"$request->userImage_base64\", \n\"personPwd\": \"123456\",
    // \n\"cardNo\": \"123456789\",\n\"supplyCards\": \"987643\",
    // \n\"certNumber\": 123456,
         
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_URL, 'https://zkbiocvs.zkteco.com/api/person/add?access_token=A3A073EAC2E44EF5D42F207602CA777358FE9E854B4AE76EFD80AF2A650C5D56');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
            $headers = [];
            $headers[] = 'Content-Type: application/json';
            //$headers[] = 'Cookie: SESSION=NWU2NGVlYWYtZjZlOS00NWYyLTkzMmQtOWU2OGIyZjljMzUy';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
            $result = curl_exec($ch);
            $res = json_decode($result);
            
            print_r($result);
            if (curl_errno($ch) || $res->code != 0) {
                // return redirect()->route('user.index')->with('error','Something is worng try again later');
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            // return;
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()
                ->route('user.index')
                ->with('error', 'Something is worng try again later');
        }
        return redirect()->route('user.index')->with('message', 'Recored Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $user = user::find($id);
        if (!$user) {
            return response()->json(['data' => '', 'status' => '404']);
        }
        $data['user'] = $user;
        $data['work_info'] = work_info::where('pd_id', $user->id)->first();
        $data['room_info'] = roomInfo::where('pd_id', $user->id)->first();

        return response()->json(['data' => $data, 'status' => '200']);
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
    public function destroy($id)
    {

         $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_URL, 'https://zkbiocvs.zkteco.com/api/person/delete/'.$id.'?access_token=A3A073EAC2E44EF5D42F207602CA777358FE9E854B4AE76EFD80AF2A650C5D56');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
    
            $headers = [];
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
            $result = curl_exec($ch);
            $res = json_decode($result);
            
            print_r($result);
            if (curl_errno($ch) || $res->code != 0) {
                // return redirect()->route('user.index')->with('error','Something is worng try again later');
                echo 'Error:' . curl_error($ch);
            }

        
        // return $id;
        $userDetail = user::find($id);
        if ($userDetail) {
            $workInfo = work_info::where('pd_id', $userDetail->id);
            if ($workInfo) {
                $workInfo->delete();
                
            }

            $roomInfo = roomInfo::where('pd_id', $userDetail->id);
            if ($roomInfo) {
                $workInfo->delete();
            }
            $userDetail->delete();
            DB::select("DELETE FROM payments where personal_detail_id_fk = $id");
            DB::select("DELETE FROM member_account where personal_detail_id_fk = $id");
            DB::select("DELETE FROM utility_usage where pd_id = $id");
            DB::select("DELETE FROM member_beds_geoms where member_id = $id");
        }
        // return
        return redirect()->route('user.index');
    }

    public function apiCreate($request)
    {
        dd($request);

        $url = 'https://zkbiocvs.zkteco.com/api/person/add?access_token=A3A073EAC2E44EF5D42F207602CA777358FE9E854B4AE76EFD80AF2A650C5D56';

        $data = '{
    "accEndTime": "2019-07-14 08:56:00",
    "accLevelIds": "1",
    "accStartTime": "2018-07-14 08:56:00",
    "birthday": "2016-07-15",
    "carPlate": "闽_A12345",
    "cardNo": "123456789",
    "certNumber": 123456,
    "certType": 2,
    "deptCode": "1",
    "email": "123%40zkteco.com",
    "gender": "F",
    "hireDate": "2019-06-10",
    "isDisabled": false,
    "isSendMail": true,
    "lastName": "testlast name",
    "mobilePhone": "15123456789",
    "name": "Abdul Rehman",
    "idCard":123123123
    "personPwd": "123456",
    "pin": "1234567",
    "ssn": "111111",
    "supplyCards": "987643"
  }';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, 'https://zkbiocvs.zkteco.com/api/person/add?access_token=A3A073EAC2E44EF5D42F207602CA777358FE9E854B4AE76EFD80AF2A650C5D56');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"pin\": \"1243\", \n\"deptCode\": \"1\", \n\"name\": \"Abdull\",\n\"lastName\": \"shah\", \n\"gender\": \"F\", \n\"accLevelIds\": \"access level group ids\"\n}");

        $headers = [];
        $headers[] = 'Content-Type: application/json';
        //$headers[] = 'Cookie: SESSION=NWU2NGVlYWYtZjZlOS00NWYyLTkzMmQtOWU2OGIyZjljMzUy';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        print_r($result);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        // $error = curl_error($ch);
        // echo 'cURL Error: ' . $error;
    }
}
