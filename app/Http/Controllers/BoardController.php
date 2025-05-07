<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
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
        $insertData['user_id'] = $user->user_id;
        $insertData['status'] = '대기';


        // insert
        $board = Project::create($insertData);
        // $board = Project::with('user')->find($board->user_id);
        $board->load('user');

        $responseData = [
            'success' => true
            ,'msg' => '프로젝트 작성 성공'
            ,'board' => $board->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 테스크 생성
    public function taskStore(Request $request) {
        try{
            $user = $request->user();
            if (!$user) {
                return response()->json(['success' => false, 'msg' => '인증된 사용자 아님'], 401);
            }
            $insertData = $request->only('content', 'project_id');
            $insertData['user_id'] = $user->user_id;
            $insertData['status'] = '대기';
    
            // Log::info('Insert Data:', $insertData);
    
    
            // insert
            $task = Task::create($insertData);
            $task = Task::with('user','project')->find($task->task_id);
    
            $responseData = [
                'success' => true
                ,'msg' => '프로젝트 작성 성공'
                ,'task' => $task->toArray()
            ];
    
            return response()->json($responseData, 200);
        } catch(\Exception $e) {
            Log::error('Task 저장 실패: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'msg' => '서버 에러',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 프로젝트 상세
    public function show(Request $request, $id) {
        $boardDetail = Project::with('task', 'user')->orderBy('created_at', 'DESC')->find($id);

        if (!$boardDetail) {
            return response()->json([
                'success' => false,
                'msg' => '해당 프로젝트를 찾을 수 없습니다.'
            ], 404);
        }

        $responseData = [
            'success' => true
            ,'msg' => '프로젝트 상세 획득 성공'
            ,'boardDetail' => $boardDetail->toArray()
        ];
        
        return response()->json($responseData, 200);
    }

    // 프로젝트 수정
    public function update(Request $request, $id) {
        $board = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string|max:200',
        ]);
    
        $board->update($validated);

        $responseData = [
            'success' => true
            ,'msg' => '프로젝트 수정 성공'
            ,'board' => $board->toArray()
        ];
        
        return response()->json($responseData, 200);
    }

    // 프로젝트 삭제
	public function deleteBoard($id) {
		// Project::beginTransaction();
		Project::destroy($id);
		// Project::commit();

		$responseData = [
			'success' => true
			,'msg' => '프로젝트 삭제'
		];
		return response()->json($responseData, 200);
	}

    // 사용자 출력
    public function userIndex(Request $request) {
        $userList = User::with('project')->orderBy('created_at', 'DESC')->get();
        $responseData = [
            'success' => true
            ,'msg' => '사용자 획득 성공'
            ,'userList' => $userList->toArray()
        ];
        
        return response()->json($responseData, 200);

    }
}
