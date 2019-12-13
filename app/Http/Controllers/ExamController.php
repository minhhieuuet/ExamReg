<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Http\Services\ExamService;
use App\Models\Exam;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    /**
     * @var ExamService
     */
    protected $examService;

    /**
     * ExamController constructor.
     *
     * @param ExamService $examService
     */
    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getExams(Request $request)
    {
        return $this->examService->getExams($request->all());
    }

    /**
     * @param Exam $exam
     * @return Exam
     */
    public function getOneExam(Exam $exam)
    {
        return $this->examService->getOneExam($exam);
    }

    /**
     * @param ExamRequest $request
     * @return Exam
     * @throws Exception
     */
    public function storeExam(ExamRequest $request)
    {
        DB::beginTransaction();
        try {
            $exam = $this->examService->storeExam($request->all());
            DB::commit();
            return $exam;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param ExamRequest $request
     * @param Exam $exam
     * @return Exam
     * @throws Exception
     */
    public function updateExam(ExamRequest $request, Exam $exam)
    {
        DB::beginTransaction();
        try {
            $exam = $this->examService->updateExam($exam, $request->all());
            DB::commit();
            return $exam;
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
    public function deleteManyExams(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $this->examService->deleteManyExams($request->all());
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Exam $exam
     * @return string
     * @throws Exception
     */
    public function deleteOneExam(Exam $exam)
    {
        DB::beginTransaction();
        try {
            $status = $this->examService->deleteOneExam($exam);
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
