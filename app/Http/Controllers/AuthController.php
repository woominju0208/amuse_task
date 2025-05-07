<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // 회원가입
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $userInfo = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $userInfo->createToken('access_token')->plainTextToken;

        $responseData = [
            'success' => true
            ,'msg' => '회원가입 성공'
            ,'accessToken' => $token
            ,'data' => $userInfo->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 로그인
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['아이디 또는 비밀번호가 틀렸습니다.'],
            ]);
        }

        // $user = $request->user();
        // $user = Auth::user();
        $user = User::with('admin')->where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => '로그인 성공',
            'accessToken' => $token,
            'tokenType' => 'Bearer',
            'data' => $user,
        ]);
    }

    // 로그아웃
    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        if($token && method_exists($token, 'delete')) {
            $token->delete();
        }
        return response()->json(['message' => '로그아웃 완료']);
    }
    
}
