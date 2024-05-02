<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/test", function (Request $request) {
    return  response()->json(["message" => "Server is working fine."]);
})->middleware(['ensureToken']);
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/user', [AuthController::class, 'profile'])->middleware(['ensureToken', 'auth:sanctum']);
Route::post('/signout', [AuthController::class, 'signOut'])->middleware('ensureToken')->name('user.signOut');

Route::apiResource('/book', BookController::class)->middleware(['ensureToken', 'auth:sanctum']);
Route::apiResource('/book.note', NoteController::class)->middleware(['ensureToken', 'auth:sanctum'])->scoped();


Route::fallback(function () {
    // return redirect()->route('events.index');
    return response(status: 400, content: '{message:"bad request"}');
});
