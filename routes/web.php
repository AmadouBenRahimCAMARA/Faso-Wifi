<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WifiController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\RetraitController;
use App\Http\Controllers\LegacyPurchaseController;
use App\Http\Controllers\LegacyTicketRetrievalController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\PublicTarifController; // Import the new controller
use App\Http\Controllers\ServiceController; // Import the new controller
use App\Http\Controllers\ContactController; // Import the new controller

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

// Public Homepage
Route::get('/', function () {
    return view('home'); // This is our public homepage with hero section
})->name("home");

// Public Services Page
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

// Public Tariffs Page
Route::get('/tarifs', [PublicTarifController::class, 'index'])->name('tarifs.index');

// Public Contact Page
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Routes du flux d'achat legacy
Route::get('/acheter-mon-ticket/{slug}', [LegacyPurchaseController::class, 'acheter'])->name('acheter');
Route::post('/faire-mon-paiement', [LegacyPurchaseController::class, 'apiPaiement'])->name('apiPaiement');
Route::get('/status', [LegacyPurchaseController::class, 'statutPaiement'])->name('statutPaiement');
Route::get('/acheter-mon-ticket/recu/{slug}', [LegacyPurchaseController::class, "recu"])->name("recu");

// Route de téléchargement de reçu (déjà refactorisée)
Route::get('/telecharger-mon-recu/{slug}', [ReceiptController::class, "download"]);

// Routes de récupération de ticket legacy
Route::get('/recuperer-mon-ticket', [LegacyTicketRetrievalController::class, 'recuperationView'])->name('recuperation');
Route::post('/recuperer-mon-ticket', [LegacyTicketRetrievalController::class, 'recuperationPost'])->name('recuperationPost');

// Route utilitaire
Route::get('/view-number/{slug}', [UtilityController::class, 'viewNumber'])->name('viewNumber');



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

// Authenticated User Dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/paiement/retrait', [PaiementController::class, 'retrait'])->name('paiement.retrait');
Route::resource('wifi', WifiController::class);
Route::resource('ticket', TicketController::class);
// Removed conflicting Route::resource('tarifs', TarifController::class);
Route::resource('paiement', PaiementController::class);
Route::resource('retrait', RetraitController::class);

// Admin Tariffs (authenticated)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('tarifs', TarifController::class);
});


/*
|--------------------------------------------------------------------------
| V2 : Routes pour la nouvelle architecture de paiement (non destructive)
|--------------------------------------------------------------------------
|
| Ces routes construisent le nouveau flux de paiement sécurisé en parallèle
| de l'ancien système. L'application existante n'est pas modifiée.
|
*/
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TicketRetrievalController;

// Groupe de routes pour la V2
Route::prefix('v2')->name('v2.')->group(function () {

    // Étape 1: L'utilisateur initie l'achat
    Route::post('/purchase/initiate', [PurchaseController::class, 'initiate'])->name('purchase.initiate');

    // Étape 3: Récupération du ticket par le client
    Route::get('/ticket/retrieve', [TicketRetrievalController::class, 'show'])->name('ticket.retrieve.show');
    Route::post('/ticket/retrieve', [TicketRetrievalController::class, 'retrieve'])->name('ticket.retrieve.submit');

    // --- Routes de SIMULATION pour le développement ---
    // Page de simulation de paiement
    Route::get('/purchase/simulate-payment/{paiement}', function(App\Models\Paiement $paiement) {
        // Simule un formulaire de paiement qui renverra une confirmation.
        return '<h2>Simulation de Paiement</h2>'
            . '<p>Montant : ' . $paiement->tarif->montant . ' CFA</p>'
            . '<p>Transaction ID local : ' . $paiement->id . '</p>'
            . '<form action="'.route('api.v2.payment.webhook').'" method="POST">'
            . '<input type="hidden" name="local_transaction_id" value="'.$paiement->id.'" />'
            . '<input type="hidden" name="gateway_transaction_id" value="gw_'.Str::uuid().'" />'
            . '<input type="hidden" name="payment_status" value="completed" />'
            . '<button type="submit">Simuler un paiement RÉUSSI</button>'
            . '</form><br>'
            . '<form action="'.route('api.v2.payment.webhook').'" method="POST">'
            . '<input type="hidden" name="local_transaction_id" value="'.$paiement->id.'" />'
            . '<input type="hidden" name="gateway_transaction_id" value="gw_'.Str::uuid().'" />'
            . '<input type="hidden" name="payment_status" value="failed" />'
            . '<button type="submit">Simuler un paiement ÉCHOUÉ</button>'
            . '</form>';
    })->name('purchase.simulatePayment');
});