<?php

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

use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

use App\Http\Controllers\AdminWifiController;

use App\Http\Controllers\AdminTarifController;

use App\Http\Controllers\AdminTicketController;

use App\Http\Controllers\AdminPaiementController;

use App\Http\Controllers\AdminRetraitController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('admin/wifis', AdminWifiController::class);
    Route::apiResource('admin/tarifs', AdminTarifController::class);
    Route::apiResource('admin/tickets', AdminTicketController::class)->except(['show', 'update']);
    Route::get('/admin/paiements', [AdminPaiementController::class, 'index']);
    Route::apiResource('admin/retraits', AdminRetraitController::class)->except(['show', 'update', 'edit']); // Withdrawals don't have show/update/edit via API
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tarifs', [\App\Http\Controllers\PublicTarifController::class, 'index']);

Route::get('/payment-status/{paiementId}', [\App\Http\Controllers\PaymentStatusController::class, 'show']);

// V2 : Route pour le webhook de paiement
Route::post('/v2/payment/webhook', [\App\Http\Controllers\PaymentWebhookController::class, 'handle'])->name('api.v2.payment.webhook');

