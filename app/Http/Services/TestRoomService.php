<?php

namespace App\Http\Services;

use App\Models\TestRoom;
use App\Models\Room;
use App\Models\ExamSession;
use Exception;

class TestRoomService
{
    /**
     * @param $params
     * @return mixed
     */
    public function getTestRooms($params)
    {
        $limit = array_get($params, 'limit', 10);

        return TestRoom::join('exam_sessions', 'test_rooms.exam_session_id', 'exam_sessions.id')
            ->join('rooms', 'test_rooms.room_id', 'rooms.id')
            ->select('test_rooms.id as id',
            'test_rooms.name as name',
            'exam_sessions.started_at as started_at',
            'exam_sessions.finished_at as finished_at',
            'rooms.name as room_name')
            ->when(!empty(array_get($params, 'search')), function ($query) use ($params) {
            $search = array_get($params, 'search');
            return $query->where('test_rooms.name', 'like', "%$search%");
        })->orderBy('test_rooms.created_at', 'desc')->paginate($limit);
    }

    /**
     * @param TestRoom $university
     * @return TestRoom
     */
    public function getOneTestRoom(TestRoom $testRoom)
    {
        return $testRoom;
    }

    /**
     * @param $params
     * @return TestRoom
     */
    public function storeTestRoom($params)
    {
        $testRoom = TestRoom::create([
            'name' => array_get($params, 'name'),
            'room_id' => array_get($params, 'room_id'),
            'exam_session_id' => array_get($params, 'exam_session_id')
        ]);

        return $this->getOneTestRoom($testRoom);
    }

    /**
     * @param TestRoom $university
     * @param $params
     * @return TestRoom
     */
    public function updateTestRoom(TestRoom $testRoom, $params)
    {
        $testRoom->update([
            'name' => array_get($params, 'name'),
            'short_name' => array_get($params, 'short_name'),
            'room_id' => array_get($params, 'room_id'),
            'exam_session_id' => array_get($params, 'exam_session_id')
        ]);

        return $testRoom;
    }

    /**
     * @param $params
     * @return string
     */
    public function deleteManyTestRooms($params)
    {
        $testRoomIds = array_get($params, 'ids', []);

        if (count($testRoomIds) > 0) {
            TestRoom::whereIn('id', $testRoomIds)->delete();
        }

        return 'ok';
    }

    /**
     * @param TestRoom $university
     * @return string
     * @throws Exception
     */
    public function deleteOneTestRoom(TestRoom $testRoom)
    {
        $testRoom->delete();

        return 'ok';
    }

    public function getAllRooms() {
      return Room::all();
    }

    public function getAllExamSessions() {
      return ExamSession::join('modules', 'exam_sessions.module_id','modules.id')
      ->join('test_sites', 'exam_sessions.test_site_id','test_sites.id')
      ->select('exam_sessions.id as id', 'modules.code as module_code', 'modules.name as module_name', 'test_sites.name as test_site_name', 'exam_sessions.started_at', 'exam_sessions.finished_at')
      ->get();
    }
}
