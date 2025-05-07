<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function index($id) {
        $comments = Comment::with('user')->where('project_id', $id)->latest()->get();
        $responseData = [
            'success' => true
            ,'msg' => '댓글 출력 성공'
            ,'commentList' => $comments->toArray()
        ];
        
        return response()->json($responseData, 200);
    }

    public function store(Request $request, $project_id) {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'msg' => '인증된 사용자 아님'], 401);
        }
    
        // content만 validate (project_id는 URL에서 받음)
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
    
        $validated['project_id'] = $project_id;
        // $validated['user_id'] = $user->user_id; // 또는 $user->user_id
        $validated['user_id'] = auth()->id();
    
        Log::debug('최종 insert 데이터:', $validated); // ← 확인용 로그
    
        $commentData = Comment::create($validated);
        

        $responseData = [
            'success' => true
            ,'msg' => '댓글 작성 성공'
            ,'commentData' => $commentData->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
