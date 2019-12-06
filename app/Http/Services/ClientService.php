<?php

namespace App\Http\Services;

use App\User;
use Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\ExamSession;
use App\Models\TestRoomUser;
use App\Models\TestRoom;

class ClientService
{

    public function getAllModules() {
    $user = Auth::user();
    $id = Auth::user()->id;
    return User::where('users.id', $id)->rightJoin('module_user', 'users.id', 'module_user.user_id')
                ->rightJoin('modules', 'module_user.module_id', 'modules.id')
                ->select(
                  'modules.id as module_id',
                  'modules.code as module_code',
                  'modules.subject_code as subject_code',
                  'modules.name as name',
                  'module_user.status as status')->get();
  }

  public function getAllModuleExamSessions($module) {
    return ExamSession::where('module_id', $module->id)
            ->join('test_sites', 'test_sites.id', 'test_site_id')
            ->leftJoin('modules', 'module_id', 'modules.id')
            ->select(
              'exam_sessions.id as id',
              'module_id',
              'test_sites.id as test_site_id',
              'modules.code as module_code',
              'modules.name as module_name',
              'test_sites.name as test_site_name',
              'exam_id',
              'exam_sessions.started_at as started_at',
              'exam_sessions.finished_at as finished_at')->get();
  }

  public function getAllRegistedSessions() {
    return TestRoomUser::where('user_id', Auth::user()->id)
            ->join('test_rooms', 'test_room_user.test_room_id', 'test_rooms.id')
            ->join('rooms', 'test_rooms.room_id', 'rooms.id')
            ->join('exam_sessions', 'test_rooms.exam_session_id', 'exam_sessions.id')
            ->join('test_sites', 'exam_sessions.test_site_id', 'test_sites.id')
            ->join('modules', 'exam_sessions.module_id', 'modules.id')
            ->select(
              'modules.code as module_code',
              'modules.name as module_name',
              'exam_sessions.started_at as started_at',
              'exam_sessions.finished_at as finished_at',
              'test_rooms.name as test_room_name',
              'rooms.name as room_name',
              'test_sites.name as test_site_name')->paginate(100);
  }
  public function totalRegistedComputers($examSession) {
    $totalRegistedComputers = TestRoomUser::join('test_rooms', 'test_room_user.test_room_id', 'test_rooms.id')
                              ->where('test_rooms.exam_session_id', $examSession->id)->count();
    return $totalRegistedComputers;
  }

  public function totalExamSessionComputers($examSession) {
    $totalRegistedComputers = $this->totalRegistedComputers($examSession);
    $totalExamSessionComputers = TestRoom::where('exam_session_id', $examSession->id)
              ->join('rooms', 'test_rooms.room_id', 'rooms.id')->sum('capacity');
    $response = ['registed_computers' => $totalRegistedComputers, 'total_computers' => $totalExamSessionComputers];
    return $response;
  }

  public function registerSession($request) {
    $sessionId = array_get($request, 'session_id');
    $session = ExamSession::find($sessionId);
    $testRooms = TestRoom::where('exam_session_id', $sessionId)->orderBy('test_rooms.id', 'asc')
            ->join('rooms', 'test_rooms.room_id', 'rooms.id')
            ->select('test_rooms.id as id', 'rooms.capacity as capacity')->get();
    $totalRegistedComputers = $this->totalRegistedComputers($session);

    //Decide which room will be select
    $computerCounter = 0;
    $selectedTestRoom = $testRooms->first();
    foreach($testRooms as $testRoom) {
      $computerCounter+= $testRoom->capacity;
      if($computerCounter > $totalRegistedComputers) {
        $selectedTestRoom = $testRoom;
        break;
      }
    }
    TestRoomUser::insert(['test_room_id' => $selectedTestRoom->id, 'user_id' => Auth::user()->id]);
    return $testRooms;
  }

}
