import BaseModelRequest from './BaseModelRequest';

export default class RoomRequest extends BaseModelRequest {
  getRooms(params) {
    const url = '/admin/modules';
    return this.get(url, params);
  }

  store(params) {

    const url = '/admin/module';

    return this.post(url, params);
  }

  show(roomId) {
    const url = '/admin/module/' + moduleId;
    return this.get(url);
  }

  update(roomId, params) {
    const url = '/admin/module/' + moduleId;
    return this.put(url, params);
  }

  removeOneRoom(roomId) {
    const url = '/admin/module/' + moduleId;
    return this.del(url);
  }

  removeManyRooms(roomIds) {
    const url = '/admin/many-modules';
    return this.del(url, {ids: moduleIds});
  }

}
