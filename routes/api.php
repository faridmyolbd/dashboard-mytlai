<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostCallAnalysisController;
use App\Http\Controllers\API\AIController; // Import the AIController
use App\Http\Controllers\DatabaseController; // Import the DatabaseController
use App\Http\Controllers\API\CallController;


// Route to get authenticated user information (if needed for your API)
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API route to get all calls
Route::get('calls', [CallController::class, 'getCalls'])->name('api.calls.index');

// API route to get a specific call's conversation
Route::get('calls/{callId}/conversation', [CallController::class, 'getConversation'])->name('api.calls.conversation');

// API route to get post-call analysis data for a specific call
Route::get('/post-call-analysis/{call_id}', [PostCallAnalysisController::class, 'show'])->name('api.post-call-analysis');



// **AI Agents Routes**
// For getting all agents (API route)
Route::get('/agents', [AIController::class, 'getAgents']);

// For getting a specific agent by ID (API route)
Route::get('/agents/{id}', [AIController::class, 'getAgent']);


//database route
// Route::get('/fetch-api-data', [DatabaseController::class, 'fetchData']);

