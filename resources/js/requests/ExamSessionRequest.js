import BaseModelRequest from './BaseModelRequest';

export default class ExamSessionRequest extends BaseModelRequest {
  getExamSessions(params) {
    const url = '/admin/exam-sessions';
    return this.get(url, params);
  }

  getAllModules(params) {
    const url = '/admin/all-module';
    return this.get(url, params);
  }

  getAllTestSites(params) {
    const url = '/admin/all-testSites';
    return this.get(url, params);
  }

  store(params) {

    const url = '/admin/exam-session';

    return this.post(url, params);
  }

  show(examSessionId) {
    const url = '/admin/exam-session/' + examSessionId;
    return this.get(url);
  }

  update(examSessionId, params) {
    const url = '/admin/examSession/' + examSessionId;
    return this.put(url, params);
  }

  removeOneExamSession(examSessionId) {
    const url = '/admin/examSession/' + examSessionId;
    return this.del(url);
  }

  removeManyExamSessions(examSessionIds) {
    const url = '/admin/many-examSessions';
    return this.del(url, {ids: examSessionIds});
  }

}
