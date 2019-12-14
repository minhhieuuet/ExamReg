import BaseModelRequest from './BaseModelRequest';

export default class ExamRequest extends BaseModelRequest {
  getExams(params) {
    const url = '/admin/exams';
    return this.get(url, params);
  }

  store(params) {

    const url = '/admin/exam';

    return this.post(url, params);
  }

  show(examId) {
    const url = '/admin/exam/' + examId;
    return this.get(url);
  }

  update(examId, params) {
    const url = '/admin/exam/' + examId;
    return this.put(url, params);
  }

  removeOneExam(examId) {
    const url = '/admin/exam/' + examId;
    return this.del(url);
  }

  removeManyExams(examIds) {
    const url = '/admin/many-exams';
    return this.del(url, {ids: examIds});
  }

}
