<?php

use App\Http\Controllers\NotaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(["web", "auth:sanctum"])->prefix("notas")->group(function () {
    Route::post("/", [NotaController::class, "index"]);
    Route::post("/store", [NotaController::class, "store"]);
    Route::post("/delete", [NotaController::class, "delete"]);
});