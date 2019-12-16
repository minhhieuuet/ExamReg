<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRoomRequest;
use App\Http\Services\TestRoomService;
use App\Models\TestRoom;
use App\Models\TestRoomUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TestRoomController extends Controller
{
    /**
     * @var TestRoomService
     */
    protected $testRoomService;

    /**
     * TestRoomController constructor.
     *
     * @param TestRoomService $testRoomService
     */
    public function __construct(TestRoomService $testRoomService)
    {
        $this->testRoomService = $testRoomService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getTestRooms(Request $request)
    {
        return $this->testRoomService->getTestRooms($request->all());
    }

    /**
     * @param TestRoom $testRoom
     * @return TestRoom
     */
    public function getOneTestRoom(TestRoom $testRoom)
    {
        return $this->testRoomService->getOneTestRoom($testRoom);
    }

    /**
     * @param TestRoomRequest $request
     * @return TestRoom
     * @throws Exception
     */
    public function storeTestRoom(TestRoomRequest $request)
    {
        DB::beginTransaction();
        try {
            $testRoom = $this->testRoomService->storeTestRoom($request->all());
            DB::commit();
            return $testRoom;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param TestRoomRequest $request
     * @param TestRoom $testRoom
     * @return TestRoom
     * @throws Exception
     */
    public function updateTestRoom(TestRoomRequest $request, TestRoom $testRoom)
    {
        DB::beginTransaction();
        try {
            $testRoom = $this->testRoomService->updateTestRoom($testRoom, $request->all());
            DB::commit();
            return $testRoom;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function deleteManyTestRooms(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $this->testRoomService->deleteManyTestRooms($request->all());
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param TestRoom $testRoom
     * @return string
     * @throws Exception
     */
    public function deleteOneTestRoom(TestRoom $testRoom)
    {
        DB::beginTransaction();
        try {
            $status = $this->testRoomService->deleteOneTestRoom($testRoom);
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getAllRooms() {
      return $this->testRoomService->getAllRooms();
    }

    public function getAllExamSessions() {
      return $this->testRoomService->getAllExamSessions();
    }

    public function printTestRoom($testRoomId) {
      $testRoom = TestRoom::join('exam_sessions', 'test_rooms.exam_session_id', 'exam_sessions.id')
          ->join('rooms', 'test_rooms.room_id', 'rooms.id')
          ->join('modules', 'exam_sessions.module_id', 'modules.id')
          ->select('test_rooms.id as id',
          'test_rooms.name as name',
          'modules.name as module_name',
          'modules.code as module_code',
          'exam_sessions.started_at as started_at',
          'exam_sessions.finished_at as finished_at',
          'rooms.name as room_name')->where('test_rooms.id', $testRoomId)->first();
      $studentsInTestRoom = TestRoomUser::where('test_room_id', $testRoomId)->join('users', 'test_room_user.user_id', 'users.id')->get();
      return view("listStudent",[
        'testRoom' => $testRoom,
        'studentList' => $studentsInTestRoom
      ]);
    }
}
