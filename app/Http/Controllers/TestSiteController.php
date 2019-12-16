<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestSiteRequest;
use App\Http\Services\TestSiteService;
use App\Models\TestSite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TestSiteController extends Controller
{
    /**
     * @var TestSiteService
     */
    protected $testSiteService;

    /**
     * TestSiteController constructor.
     *
     * @param TestSiteService $testSiteService
     */
    public function __construct(TestSiteService $testSiteService)
    {
        $this->testSiteService = $testSiteService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getTestSites(Request $request)
    {
        return $this->testSiteService->getTestSites($request->all());
    }

    /**
     * @param TestSite $testSite
     * @return TestSite
     */
    public function getOneTestSite(TestSite $testSite)
    {
        return $this->testSiteService->getOneTestSite($testSite);
    }

    /**
     * @param TestSiteRequest $request
     * @return TestSite
     * @throws Exception
     */
    public function storeTestSite(TestSiteRequest $request)
    {
        DB::beginTransaction();
        try {
            $testSite = $this->testSiteService->storeTestSite($request->all());
            DB::commit();
            return $testSite;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param TestSiteRequest $request
     * @param TestSite $testSite
     * @return TestSite
     * @throws Exception
     */
    public function updateTestSite(TestSiteRequest $request, TestSite $testSite)
    {
        DB::beginTransaction();
        try {
            $testSite = $this->testSiteService->updateTestSite($testSite, $request->all());
            DB::commit();
            return $testSite;
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
    public function deleteManyTestSites(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $this->testSiteService->deleteManyTestSites($request->all());
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param TestSite $testSite
     * @return string
     * @throws Exception
     */
    public function deleteOneTestSite(TestSite $testSite)
    {
        DB::beginTransaction();
        try {
            $status = $this->testSiteService->deleteOneTestSite($testSite);
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getAllExams() {
      return $this->testSiteService->getAllExams();
    }
}
