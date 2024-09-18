<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;

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

Route::get('/todos', [TodosController::class, 'index']);
Route::get('/todos/{id}', [TodosController::class, 'show']);
Route::post('/todos', [TodosController::class, 'store']);
Route::put('/todos/{id}', [TodosController::class, 'update']);
Route::delete('/todos/{id}', [TodosController::class, 'destroy']);
