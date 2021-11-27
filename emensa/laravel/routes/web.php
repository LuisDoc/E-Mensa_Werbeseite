<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NLAdminPanel;
use App\Http\Controllers\ExampleController;
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
Route::get('/showNewsletterAdmin/NameAsc',[NLAdminPanel::class,'viewPanelSortedByNameAsc']);
Route::get('/showNewsletterAdmin/EmailAsc',[NLAdminPanel::class,'viewPanelSortedByEmailAsc']);
/*
Suchen
*/
Route::post("showNewsletterAdmin/search",[NLAdminPanel::class,'search']);
Route::get('/showNewsletterAdmin',[NLAdminPanel::class, 'viewPanel']);

/*
Aufgabe 6
*/
Route::get('m4_6a_queryparameter',[ExampleController::class, 'queryparameter']);
Route::get('m4_6b_kategorie',[ExampleController::class,'kategorie']);
Route::get('m4_6c_gerichte',[ExampleController::class,'gerichte']);
Route::get('m4_6d_layout',[ExampleController::class,'pick_page']);