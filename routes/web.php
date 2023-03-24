<?php

use App\Http\Controllers\application;
use App\Http\Controllers\ApplicationGeom;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\userDetail;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CCTVController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\UtilityController;

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

    Route::get('dashboard',[DashboardController::class,'index']);
    
    Route::get('/',[DashboardController::class,'index']);

    Route::get('/personal/{id}',[userDetail::class,'personal']);

    Route::resource('user',userDetail::class);
    Route::resource('payment',PaymentController::class);
 
    Route::get('/get-all-users',[AvailabilityController::class,'index']);

    Route::get('/update-availability',[AvailabilityController::class,'update']);
 
    Route::get('cctv',[CCTVController::class,'index']);
    Route::post('genratePatments',[PaymentController::class,'genratePatments']);

    Route::post('/make-payment',[PaymentController::class,'makePayment']);

    
    Route::post('/search-payment',[PaymentController::class,'searchPayment']);


  /// Manage Balacne 
    Route::resource('manage-balance',BalanceController::class);



 
 
 
    
    
});
    /// Utility
Route::resource('/utility',UtilityController::class);

Route::get('api-test',[userDetail::class,'apiTest']);
 // Check in or out

 Route::get('aero-hostel-management-system',[CheckInController::class,'index']);
Route::get('/user/check-in/{id}',[CheckInController::class,'checkIn']);

 
