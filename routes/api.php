<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;


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

Route::resource('transactions', TransactionController::class);
Route::get('/owner/{owner}', [TransactionController::class, 'owner']);
Route::get('/categories/{owner}', [TransactionController::class, 'categories']);
Route::get('/sum/{owner}', [TransactionController::class, 'sum']);


// Route::get('/transactions', [TransactionController::class, 'index']);
// Route::post('/transactions', [TransactionController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
