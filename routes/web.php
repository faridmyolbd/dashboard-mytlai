<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AIController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\API\PostCallAnalysisController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\API\APIKeyController;




Route::middleware('auth')->group(function(){
    // Home Route (Dashboard)
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Agents Route (Using AIController for better organization)
    Route::get('agents-list', [AIController::class, 'showAgentList'])->name('agents-list');
    Route::get('post-call-analysis/{call_id}', [PostCallAnalysisController::class, 'show'])->name('post-call-analysis');


    // Calls Routes Group
    Route::prefix('calls')->group(function () {
        Route::get('call-list', function () {
            return view('calls.call-list');
        })->name('call-list');
    });
});

//api keys routes
Route::prefix('api-keys')->group(function () {
    Route::get('/', [APIKeyController::class, 'index'])->name('api-keys.index');
    Route::get('/create', [APIKeyController::class, 'create'])->name('api-keys.create');
    Route::post('/', [APIKeyController::class, 'store'])->name('api-keys.store');
    Route::get('/{id}', [APIKeyController::class, 'show'])->name('api-keys.show');
    Route::post('/{id}/revoke', [APIKeyController::class, 'revoke'])->name('api-keys.revoke');
});



require __DIR__.'/auth.php';
