import BaseModelRequest from './BaseModelRequest';

export default class StudentRequest extends BaseModelRequest {
  getStudents(params) {
    const url = '/admin/students';
    return this.get(url, params);
  }

  store(params) {

    const url = '/admin/student';

    return this.post(url, params);
  }

  show(studentId) {
    const url = '/admin/student/' + studentId;
    return this.get(url);
  }

  update(studentId, params) {
    const url = '/admin/student/' + studentId;
    return this.put(url, params);
  }

  removeOneStudent(studentId) {
    const url = '/admin/student/' + studentId;
    return this.del(url);
  }

  removeManyStudents(studentIds) {
    const url = '/admin/many-students';
    return this.del(url, {ids: studentIds});
  }

}
