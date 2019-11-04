<?php

namespace App\Http\Controllers;
use App\Http\Services\StudentService;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function getOneStudent(Student $student){
      return $this->studentService->getOneStudent($student);
    }

    public function storeStudent(Request $request)
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

    public function updateStudent(Request $request, Student $student)
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

    public function deleteOneStudent(Student $student)
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

    public function deleteManyStudent(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $this->studentService->deleteManyStudent($request->all());
            DB::commit();
            return $status;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }


}