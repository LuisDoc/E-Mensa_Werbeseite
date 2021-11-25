<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NLAdminPanel;

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
Sortierungen
*/
Route::get('/showNewsletterAdmin/NameAsc',[NLAdminPanel::class,'viewPanelSortedByNameAsc']);
Route::get('/showNewsletterAdmin/EmailAsc',[NLAdminPanel::class,'viewPanelSortedByEmailAsc']);
/*
Suchen
*/
Route::post("showNewsletterAdmin/search",[NLAdminPanel::class,'search']);

Route::get('/showNewsletterAdmin',[NLAdminPanel::class, 'viewPanel']);