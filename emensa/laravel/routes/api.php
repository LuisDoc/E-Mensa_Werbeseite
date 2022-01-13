<?php

use Illuminate\Http\Request;
use App\Models\Gericht;
use App\Models\Allergen;
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

/*
    Testrouten
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getGerichte', function(Request $request){
    return Gericht::all();
});

Route::get('/getAllergen/{code}', function(Request $request){
    return Allergen::where('code',$request->code)->get();
});
