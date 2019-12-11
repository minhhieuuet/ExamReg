import BaseModelRequest from './BaseModelRequest';

export default class TestRoomRequest extends BaseModelRequest {
  getTestRooms(params) {
    const url = '/admin/test-rooms';
    return this.get(url, params);
  }

  store(params) {

    const url = '/admin/test-room';

    return this.post(url, params);
  }

  show(testRoomId) {
    const url = '/admin/test-room/' + testRoomId;
    return this.get(url);
  }

  update(testRoomId, params) {
    const url = '/admin/test-room/' + testRoomId;
    return this.put(url, params);
  }

  removeOneTestRoom(testRoomId) {
    const url = '/admin/test-room/' + testRoomId;
    return this.del(url);
  }

  removeManyTestRooms(testRoomIds) {
    const url = '/admin/many-test-rooms';
    return this.del(url, {ids: testRoomIds});
  }

  getAllRooms() {
    const url = '/admin/all-rooms';
    return this.get(url);
  }

  getAllExamSessions() {
    const url ='/admin/all-exam-sessions';
    return this.get(url);
  }

}
