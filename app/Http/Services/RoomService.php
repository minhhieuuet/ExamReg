<?php

namespace App\Http\Services;

use App\Models\Room;
use Exception;

class RoomService
{
    /**
     * @param $params
     * @return mixed
     */
    public function getRooms($params)
    {
        $limit = array_get($params, 'limit', 10);

        return Room::when(!empty(array_get($params, 'search')), function ($query) use ($params) {
            $search = array_get($params, 'search');
            return $query->where('name', 'like', "%$search%")->orWhere('capacity', 'like', "%$search%");
        })->orderBy('created_at', 'desc')->paginate($limit);
    }

    /**
     * @param Room $room
     * @return Room
     */
    public function getOneRoom(Room $room)
    {
        return $room;
    }

    /**
     * @param $params
     * @return Room
     */
    public function storeRoom($params)
    {
        $room = Room::create([
            'name' => array_get($params, 'name'),
            'capacity' => array_get($params, 'capacity'),
        ]);

        return $this->getOneRoom($room);
    }

    /**
     * @param Room $room
     * @param $params
     * @return Room
     */
    public function updateRoom(Room $room, $params)
    {
        $room->update([
          'name' => array_get($params, 'name'),
          'capacity' => array_get($params, 'capacity'),
        ]);

        return $room;
    }

    /**
     * @param $params
     * @return string
     */
    public function deleteManyRooms($params)
    {
        $roomIds = array_get($params, 'ids', []);

        if (count($roomIds) > 0) {
            Room::whereIn('id', $roomIds)->delete();
        }

        return 'ok';
    }

    /**
     * @param Room $room
     * @return string
     * @throws Exception
     */
    public function deleteOneRoom(Room $room)
    {
        $room->delete();

        return 'ok';
    }
}
