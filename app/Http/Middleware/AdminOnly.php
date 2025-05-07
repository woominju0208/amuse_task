<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if(!$user || !Admin::where('user_id', $user->user_id)->exists()) {
            Log::warning('접근 차단 - 관리자 아님', ['user_id' => $user?->user_id]);
            return response()->json(['message' => '관리자만 접근 가능합니다.'], 403);
        }
    
        Log::info('접근 허용 - 관리자 확인됨', ['user_id' => $user->id]);
        return $next($request);
    }
}
