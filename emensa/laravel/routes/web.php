<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NLAdminPanelController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\AuthController;
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

Route::post('/SignUpNewsletter',[NewsletterController::class, 'signupNL']);

Route::get('/',[HomeController::class, 'index']);



/*
Wunschgerichte Webseite
*/
Route::get('/requestMeal',[HomeController::class, 'requestMeal']);
Route::post('/sendWunschgericht',[HomeController::class, 'validateMeal']);
/*
Sortierungen
*/
Route::get('/showNewsletterAdmin/NameAsc',[NLAdminPanelController::class,'viewPanelSortedByNameAsc']);
Route::get('/showNewsletterAdmin/EmailAsc',[NLAdminPanelController::class,'viewPanelSortedByEmailAsc']);
/*
Suchen
*/
Route::post("showNewsletterAdmin/search",[NLAdminPanelController::class,'search']);
Route::get('/showNewsletterAdmin',[NLAdminPanelController::class, 'viewPanel']);

/*
Aufgabe 6
*/
Route::get('m4_6a_queryparameter',[ExampleController::class, 'queryparameter']);
Route::get('m4_6b_kategorie',[ExampleController::class,'kategorie']);
Route::get('m4_6c_gerichte',[ExampleController::class,'gerichte']);
Route::get('m4_6d_layout',[ExampleController::class,'pick_page']);


/*
Authentication routes
*/

Route::get('login',[AuthController::class, 'indexLogin']);
Route::get('register',[AuthController::class, 'indexRegister']);
Route::get('signout',[AuthController::class, 'signOut']);
Route::post('custom-login',[AuthController::class, 'login']);
Route::post('custom-register',[AuthController::class, 'register']);

