<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
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
    // 프로젝트 작성
    Route::post('/boards/store', [BoardController::class, 'store'])->name('boards.store');
    // 프로젝트 상세
    Route::get('/boards/{id}', [BoardController::class, 'show'])->name('boards.show');
    // 프로젝트 수정
    Route::put('/boards/{id}', [BoardController::class, 'update'])->name('boards.update');

    // 프로젝트 삭제
    Route::delete('/boards/{id}', [BoardController::class, 'deleteBoard'])->name('boards.delete');
    
    // 테스크 작성
    Route::post('/boards/{id}/task', [BoardController::class, 'taskStore'])->name('tasks.store');

    // 사용자 출력
    Route::get('/users', [BoardController::class, 'userIndex'])->name('users.index');

    // 댓글 출력
    Route::get('/boards/{id}/comments', [CommentController::class, 'index'])->name('comments.index');
    // 댓글 작성
    Route::post('/boards/{project_id}/comments/store', [CommentController::class, 'store'])->name('comments.store');
});
