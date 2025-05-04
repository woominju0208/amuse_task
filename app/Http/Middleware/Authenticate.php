<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        // // API 요청이면 JSON 반환
        // if ($request->expectsJson()) {
            return null;
    //     }

    //     // 웹 요청일 경우만 로그인 페이지로
    //     return route('login');
    }
}
