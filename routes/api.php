<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
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
// 회원가입
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
// 로그인
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth:sanctum')->group(function() {
    // 로그아웃
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    // 프로젝트 출력
    Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');
    // 프로젝트 상태 변경
    Route::post('/boards/{id}/status', [BoardController::class, 'updateStatus']);
    // 프로젝트 생성
    Route::post('/boards/store', [BoardController::class, 'store'])->name('boards.store');
});
