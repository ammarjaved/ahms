<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_type' => 'required',
            'division' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $dbkl  = '';
        $vendor = '';

        if($request->user_type == "dbkl"){
            $dbkl = $request->dbkl_user_type;
        }elseif ($request->user_type == "vendor"){
            $vendor = $request->vendor_user_type;
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'division' => $request->division,
            'phone' => $request->phone,
            'address' => $request->address,
            'app_user_type' => $request->user_type,
            'dbkl_user_type' => $dbkl,
            'vendor_user_type' => $vendor,
            'password' => Hash::make($request->password),

        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
