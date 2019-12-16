<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\ExamSession;
use App\Models\TestRoom;
use App\Models\Module;
class SummaryController extends Controller
{
    public function getSummaryReport() {
      $totalStudent = User::where('role', 1)->count();
      $totalExamSession = ExamSession::count();
      $totalModule = Module::count();
      $totalTestRoom = TestRoom::count();

      $response = ['total_student' => $totalStudent, 'total_exam_session' => $totalExamSession, 'total_module' => $totalModule, 'total_test_room' => $totalTestRoom];
      return $response;
    }
}
