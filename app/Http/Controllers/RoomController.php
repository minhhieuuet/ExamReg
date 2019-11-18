<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Services\RoomService;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    /**
     * @var RoomService
     */
    protected $roomService;

    /**
     * RoomController constructor.
     *
     * @param RoomService $roomService
     */
    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getRooms(Request $request)
    {
        return $this->roomService->getRooms($request->all());
    }

    /**
     * @param Room $room
     * @return Room
     */
    public function getOneRoom(Room $room)
    {
        return $this->roomService->getOneRoom($room);
    }

    /**
     * @param RoomRequest $request
     * @return Room
     * @throws Exception
     */
    public function storeRoom(RoomRequest $request)
    {
        DB::beginTransaction();
        try {
            $room = $this->roomService->storeRoom($request->all());
            DB::commit();
            return $room;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param RoomRequest $request
     * @param Room $room
     * @return Room
     * @throws Exception
     */
    public function updateRoom(RoomRequest $request, Room $room)
    {
        DB::beginTransaction();
        try {
            $room = $this->roomService->updateRoom($room, $request->all());
            DB::commit();
            return $room;
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
    public function deleteManyRooms(Request $request)
    {
        DB::beginTransaction();
        try {
            $status = $this->roomService->deleteManyRooms($request->all());
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * @param Room $room
     * @return string
     * @throws Exception
     */
    public function deleteOneRoom(Room $room)
    {
        DB::beginTransaction();
        try {
            $status = $this->roomService->deleteOneRoom($room);
            DB::commit();
            return $status;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
