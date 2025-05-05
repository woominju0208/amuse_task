<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoardController extends Controller
{
    // 프로젝트 출력
    public function index(Request $request) {
        $boardList = Project::with('user')->orderBy('created_at', 'DESC')->get();

        $responseData = [
            'success' => true
            ,'msg' => '프로젝트 획득 성공'
            ,'boardList' => $boardList->toArray()
        ];
        
        return response()->json($responseData, 200);
    }

    // 프로젝트 상태 변경
    public function updateStatus(Request $request, $id) {

        Log::info('상태변경 요청 도착', [$id, $request->all()]);
        $project = Project::findOrFail($id);
        $project->status = $request->input('status');
        $project->save();

        return response()->json([
            'success' => true,
            'msg' => '상태 업데이트 성공',
            'updated' => $project->status,
        ]);
    }

    // 프로젝트 생성
    public function store(Request $request) {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'msg' => '인증된 사용자 아님'], 401);
        }
        $insertData = $request->only(['title', 'description']);
        $insertData['user_id'] = $user->id;
        $insertData['status'] = '대기';


        // insert
        $board = Project::create($insertData);

        $responseData = [
            'success' => true
            ,'msg' => '프로젝트 작성 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }
}
