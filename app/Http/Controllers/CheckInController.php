<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    //

    public function index()
    {
        return view('UsersCheck.index', ['users' => UserDetail::all()]);
    }

    public function checkIn($id)
    {
        $user   = UserDetail::find($id);

        $status = $user->availability == 'available' ? 'unavailable' : 'available';

        $user->availability = $status;
        $update = $user->update();

        return $update ? response()->json(['status' => 200]) : response()->json(['status' => 400]);
    }
}
