<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WifiController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\RetraitController;
use App\Http\Controllers\Controller;
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

Route::get('/', function () {
    return view('index');
})->name("index");

Route::get('/acheter-mon-ticket/{slug}', [Controller::class, 'acheter'])->name('acheter');
Route::post('/faire-mon-paiement', [Controller::class, 'apiPaiement'])->name('apiPaiement');
Route::get('/status', [Controller::class, 'statutPaiement'])->name('statutPaiement');

Route::get('/acheter-mon-ticket/recu/{slug}',[Controller::class,"recu"])->name("recu");
Route::get('/telecharger-mon-recu/{slug}',[Controller::class,"downloadRecu"]);
Route::get('/recuperer-mon-ticket', [Controller::class, 'recuperationView'])->name('recuperation');
Route::post('/recuperer-mon-ticket', [Controller::class, 'recuperationPost'])->name('recuperationPost');
Route::get('/view-number/{slug}', [Controller::class, 'viewNumber'])->name('viewNumber');


Route::get('/paiement-mobile', function () {
    return view('paiement.payin');
})->name("paiementMobile");

Route::get('/connexion', function () {
    return view('connexion');
})->name("connexion");
Route::get('/inscription', function () {
    return view('inscription');
})->name("inscription");




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/paiement/retrait', [PaiementController::class, 'retrait'])->name('paiement.retrait');
Route::resource('wifi', WifiController::class);
Route::resource('ticket', TicketController::class);
Route::resource('tarifs', TarifController::class);
Route::resource('paiement', PaiementController::class);
Route::resource('retrait', RetraitController::class);
