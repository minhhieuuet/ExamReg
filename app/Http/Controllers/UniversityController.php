<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniversityRequest;
use App\Http\Services\UniversityService;
use App\Models\University;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UniversityController extends Controller
{
    /**
     * @var UniversityService
     */
    protected $universityService;

    /**
     * UniversityController constructor.
     *
     * @param UniversityService $universityService
     */
    public function __construct(UniversityService $universityService)
    {
        $this->universityService = $universityService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getUniversities(Request $request)
    {
        return $this->universityService->getUniversities($request->all());
    }

    /**
     * @param University $university
     * @return University
     */
    public function getOneUniversity(University $university)
    {
        return $this->universityService->getOneUniversity($university);
    }

    /**
     * @param UniversityRequest $request
     * @return University
     * @throws Exception
     */
    public function storeUniversity(UniversityRequest $request)
    {
        DB::beginTransaction();
        try {
            $university = $this->universityService->storeUniversity($request->all());
            DB::commit();
            return $university;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param UniversityRequest $request
     * @param University $university
     * @return University
     * @throws Exception
     */
    public function updateUniversity(UniversityRequest $request, University $university)
    {
        DB::beginTransaction();
        try {
            $university = $this->universityService->updateUniversity($university, $request->all());
            DB::commit();
            return $university;
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
    public function deleteManyUniversities(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $this->universityService->deleteManyUniversities($request->all());
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param University $university
     * @return string
     * @throws Exception
     */
    public function deleteOneUniversity(University $university)
    {
        DB::beginTransaction();
        try {
            $status = $this->universityService->deleteOneUniversity($university);
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
