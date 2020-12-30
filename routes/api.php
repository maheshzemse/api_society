<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;


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


Route::middleware('auth:api')->group(function () {
    Route::get('user', [VisitorController::class,'details']);
 
    Route::post('add',[VisitorController::class,'add']);

Route::get('list',[VisitorController::class,'list']);

Route::get('getlist/{id}', [VisitorController::class,'getlist']);

});

Route::post('login', [VisitorController::class,'login']);
Route::post('register', [VisitorController::class,'register']);
