<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\UrlShortcutsController;
use App\Http\Controllers\SettingsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth.api_key'])->group(
    function () {
        Route::get('/todos', [TodosController::class, 'index']);
        Route::get('/todos/{id}', [TodosController::class, 'show']);
        Route::post('/todos', [TodosController::class, 'store']);
        Route::put('/todos/{id}', [TodosController::class, 'update']);
        Route::delete('/todos/{id}', [TodosController::class, 'destroy']);

        Route::get('/settings', [SettingsController::class, 'index']);
        Route::get('/settings/{id}', [SettingsController::class, 'show']);
        Route::post('/settings', [SettingsController::class, 'store']);
        Route::put('/settings/{id}', [SettingsController::class, 'update']);
        Route::delete('/settings/{id}', [SettingsController::class, 'destroy']);

        Route::get('/url_shortcuts', [UrlShortcutsController::class, 'index']);
        Route::get('/url_shortcuts/{id}', [UrlShortcutsController::class, 'show']);
        Route::post('/url_shortcuts', [UrlShortcutsController::class, 'store']);
        Route::put('/url_shortcuts/{id}', [UrlShortcutsController::class, 'update']);
        Route::delete('/url_shortcuts/{id}', [UrlShortcutsController::class, 'destroy']);
    }
);
