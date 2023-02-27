<?php


use App\Http\Controllers\ApiControllers\UpdateUserInfo;
use App\Http\Controllers\ApiControllers\UploadImages;
use App\Http\Controllers\ApiControllers\SalaryController;
use App\Http\Controllers\ApiControllers\DBController;
use App\Http\Controllers\ApiControllers\Geofencing;
use App\Http\Controllers\ApiControllers\GetDetailsController;
use App\Http\Controllers\ApiControllers\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){

});


Route::post("/database/GetResults",[DBController::class,'GetResults']);
Route::post("/database/insert",[DBController::class,'insert']);
Route::post("/database/update",[DBController::class,'update']);
Route::get('/test',[App\Http\Controllers\ApiControllers\LoginController::class,"test"]);
Route::post('/upload-maid-images',[UploadImages::class,"upload"]);
Route::post('/update-maid-info/{id}',[UpdateUserInfo::class,"updateMaid"]);
Route::post('/update-client-info/{id}',[UpdateUserInfo::class,"updateClient"]);
Route::post('/addsalary-maid',[SalaryController::class,"addSalaryInfo"]);
Route::post("/check-user-location",[Geofencing::class,"userLocation"]);
Route::post("/track-user-location",[Geofencing::class,"TrackUserLocation"]);
Route::post("/send-mail",[SendMail::class,"sendMail"]);

Route::get('/get-assigned-maids/{client_user_name}',[GetDetailsController::class,'assignedMaids']);
Route::get('/get-maid-detail/{maid_user_name}',[GetDetailsController::class,'maidDetail']);
Route::get('/get-agency-detail/{client_user_name}',[GetDetailsController::class,'getAgency']);


Route::post('/login',[App\Http\Controllers\ApiControllers\LoginController::class,"login"]);