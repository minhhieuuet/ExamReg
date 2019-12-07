<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamSessionRequest;
use App\Http\Services\ExamSessionService;
use App\Models\ExamSession;
use App\Models\Module;
use App\Models\TestSite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExamSessionController extends Controller
{
    /**
     * @var ExamSessionService
     */
    protected $examSessionService;

    /**
     * ExamSessionController constructor.
     *
     * @param ExamSessionService $examSessionService
     */
    public function __construct(ExamSessionService $examSessionService)
    {
        $this->examSessionService = $examSessionService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getExamSessions(Request $request)
    {
        return $this->examSessionService->getExamSessions($request->all());
    }

    /**
     * @param ExamSession $examSession
     * @return ExamSession
     */
    public function getOneExamSession(ExamSession $examSession)
    {
        return $examSession;
    }

    public function getAllModules()
    {
      return Module::all();
    }

    public function getAllTestSites()
    {
      return TestSite::all();
    }
    /**
     * @param ExamSessionRequest $request
     * @return ExamSession
     * @throws Exception
     */
    public function storeExamSession(ExamSessionRequest $request)
    {
        DB::beginTransaction();
        try {
            $examSession = $this->examSessionService->storeExamSession($request->all());
            DB::commit();
            return $examSession;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param ExamSessionRequest $request
     * @param ExamSession $examSession
     * @return ExamSession
     * @throws Exception
     */
    public function updateExamSession(ExamSessionRequest $request, ExamSession $examSession)
    {
        DB::beginTransaction();
        try {
            $examSession = $this->examSessionService->updateExamSession($examSession, $request->all());
            DB::commit();
            return $examSession;
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
    public function deleteManyExamSessions(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $this->examSessionService->deleteManyExamSessions($request->all());
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param ExamSession $examSession
     * @return string
     * @throws Exception
     */
    public function deleteOneExamSession(ExamSession $examSession)
    {
        DB::beginTransaction();
        try {
            $status = $this->examSessionService->deleteOneExamSession($examSession);
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
