<?php

use App\Http\Controllers\application;
use App\Http\Controllers\ApplicationGeom;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\userDetail;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/home', function () {
//     return view('index');
// })->middleware('auth')->name('home');

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {

    Route::view('dashboard',"dashboard");
    Route::get('dashboard',function(){
        return view('dashboard');
    });
    Route::get('/',[DashboardController::class,'index']);

    Route::get('/personal/{id}',[userDetail::class,'personal']);

    Route::resource('user',userDetail::class);
    Route::resource('payment',PaymentController::class);

    
    
});

 

Route::group(['prefix' => '/'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});
