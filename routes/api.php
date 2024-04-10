<?php
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PhoneController;
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
Route::resource('posts', PostController::class);
Route::resource('users', UsersController::class);
Route::get('phones/{id}', [PhoneController::class, 'show']);
// Route::get('/posts', [PostController::class,'index']);
// Route::get('/posts/{id}', [PostController::class,'show']);
// Route::post('/posts', [PostController::class,'store']);
// Route::delete('/posts/{id}', [PostController::class,'destroy']);
// Route::put('/posts/{id}', [PostController::class,'update']);