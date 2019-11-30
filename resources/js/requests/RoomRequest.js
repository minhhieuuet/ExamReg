import BaseModelRequest from './BaseModelRequest';

export default class RoomRequest extends BaseModelRequest {
  getRooms(params) {
    const url = '/admin/rooms';
    return this.get(url, params);
  }

  store(params) {

    const url = '/admin/room';

    return this.post(url, params);
  }

  show(roomId) {
    const url = '/admin/room/' + roomId;
    return this.get(url);
  }

  update(roomId, params) {
    const url = '/admin/room/' + roomId;
    return this.put(url, params);
  }

  removeOneRoom(roomId) {
    const url = '/admin/room/' + roomId;
    return this.del(url);
  }

  removeManyRooms(roomIds) {
    const url = '/admin/many-rooms';
    return this.del(url, {ids: roomIds});
  }

}
