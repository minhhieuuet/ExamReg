<?php

namespace App\Http\Controllers;
use App\Http\Services\StudentService;
use Illuminate\Http\Request;
use App\Models\Student;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    public function getStudents(Request $request){
      return $this->studentService->getStudents($request->all());
    }

    public function getOneStudent(User $student){
      return $this->studentService->getOneStudent($student);
    }

    public function storeStudent(StudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $student = $this->studentService->storeStudent($request->all());
            DB::commit();
            return $student;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function updateStudent(StudentRequest $request, User $student)
    {
        DB::beginTransaction();
        try {
            $student = $this->studentService->updateStudent($student, $request->all());
            DB::commit();
            return $student;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function deleteOneStudent(User $student)
    {
        DB::beginTransaction();
        try {
            $status = $this->studentService->deleteOneStudent($student);
            DB::commit();
            return $status;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function deleteManyStudents(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $this->studentService->deleteManyStudents($request->all());
            DB::commit();
            return $status;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }


}
