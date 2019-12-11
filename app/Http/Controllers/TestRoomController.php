<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRoomRequest;
use App\Http\Services\TestRoomService;
use App\Models\TestRoom;
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
}
