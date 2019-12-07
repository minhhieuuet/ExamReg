import BaseModelRequest from './BaseModelRequest';

export default class UserRequest extends BaseModelRequest {
  getModelName () {
    return 'users';
  }

  getAllAvaiableExamSessions(moduleId) {
    return this.get('/user/all-exam-sessions/' + moduleId);
  }

  getAllModules() {
    return this.get('/user/all-modules');
  }

  getAllRegistedSessions() {
    return this.get('/user/all-registed-sessions');
  }

  getTotalExamSessionComputers (examSessionId) {
    return this.get('/user/exam-session-computers/' + examSessionId);
  }
  registerSession (sessionId) {
    return this.post('/user/register-session/', {session_id: sessionId});
  }
  unRegisterASession (testRoomId) {
    return this.post('/user/unregister-session', {test_room_id: testRoomId});
  }

  isRegistedModule(moduleId) {
    return this.get('/user/is-registed-module/' + moduleId);
  }

  login (params) {
    return this.post('/auth/login', params);
  }

  register (email, password, recaptcha, referrer_code) {
    const params = {
      email,
      password,
      recaptcha,
      password_confirmation: password,
    };
    return this.post('/auth/users', params);
  }

  resendConfirmEmail (email, recaptcha) {
    const params = { email, recaptcha, locale: window.i18n.locale };
    return this.post('/resend-confirm-email', params);
  }

  forgotPassword (params) {
    return this.post('/forgot-password', params);
  }

  resetPassword (email, password, token, recaptcha) {
    const params = {
      email,
      password,
      password_confirmation: password,
      token,
      recaptcha,
    };
    return this.post('/reset-password', params);
  }

  confirmEmail (code) {
    const params = { code };
    return this.get('/confirm-email', params);
  }

  getCurrentUser (useCache = false, params) {
    if (this.user && useCache) {
      return new Promise((resolve) => {
        resolve(this.user);
      });
    }

    return new Promise((resolve, reject) => {
      const url = '/auth/user';
      const self = this;
      this.get(url, params)
        .then((user) => {
          self.user = user;
          resolve(user);
        })
        .catch((error) => {
          reject(error);
        });
    });
  }

}
