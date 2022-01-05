<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NLAdminPanelController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BewertungenController;
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
Testrouten
*/
Route::get('testAddGericht',[HomeController::class,'testAddGericht']);


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
Bewertungen | Meilenstein 6
*/
Route::get('bewertungen',[BewertungenController::class,'bewertungen']);
Route::get('bewertung/{id}',[BewertungenController::class,'bewertung']);
Route::get('sendBewertung/{id}',[BewertungenController::class,'addBewertung']);
Route::get('highlightBewertung/{id}',[BewertungenController::class,'highlight']);
Route::get('meineBewertungen',[BewertungenController::class,'MyBewertungen']);
Route::get('deleteBewertung/{id}',[BewertungenController::class,'destroy']);

/*
Authentication routes
*/

Route::get('anmeldung',[AuthController::class, 'indexLogin'])->name('login');
Route::get('registrieren',[AuthController::class, 'indexRegister']);
Route::get('abmelden',[AuthController::class, 'signOut'])->middleware('auth');
Route::post('anmeldung_verifizieren',[AuthController::class, 'login']);
Route::post('registrieren-verifizieren',[AuthController::class, 'register']);

