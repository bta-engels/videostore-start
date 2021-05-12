<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\Api\ApiTodoController;
use App\Http\Controllers\Api\ApiLoginController;

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
Route::post('login', [ApiLoginController::class, 'login']);

Route::apiResource('todos', ApiTodoController::class)
    ->only(['index','show'])
;
Route::apiResource('todos', ApiTodoController::class)
    ->except(['index','show'])
    ->middleware('auth:sanctum')
;

Route::fallback(function () {
    return response()->json(['error' => 'route not found']);
});
