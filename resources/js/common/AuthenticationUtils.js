import Vue from 'vue';

export default class AuthenticationUtils {

  static isAuthenticated () {
    return !!AuthenticationUtils.accessToken;
  }

  static saveAuthenticationData (data) {
    AuthenticationUtils.accessToken = data.access_token || '';
    window.sessionStorage.setItem('access_token', data.access_token || '');
    window.sessionStorage.setItem('prev_login', data.access_token ? new Date().valueOf() : '');
  }

  static removeAuthenticationData () {
    AuthenticationUtils.saveAuthenticationData({});
    AuthenticationUtils.prevLogin = '';
    AuthenticationUtils.accessToken = '';
  }

  static getAccessToken () {
    AuthenticationUtils.loadDataIfNeed();

    return AuthenticationUtils.accessToken;
  }

  static getPrevLogin () {
    AuthenticationUtils.loadDataIfNeed();
    return AuthenticationUtils.prevLogin;
  }

  static loadData () {
    AuthenticationUtils.prevLogin = window.sessionStorage.getItem('prev_login') || '';
    AuthenticationUtils.accessToken = window.sessionStorage.getItem('access_token') || '';
    AuthenticationUtils.dataLoaded = true;
  }

  static loadDataIfNeed () {
    if (AuthenticationUtils.dataLoaded === undefined || !AuthenticationUtils.dataLoaded) {
      AuthenticationUtils.loadData();
    }
  }

  static logout () {
    AuthenticationUtils.removeAuthenticationData();
    Vue.prototype.$isAuthenticated = window.isAuthenticated = false;
    window.axios.defaults.headers.common.Authorization = '';

  }

  static async login (token) {
    await AuthenticationUtils.saveAuthenticationData(token);
    window.axios.defaults.headers.common.Authorization = `Bearer ${AuthenticationUtils.getAccessToken()}`;

    // window.isAuthenticated = AuthenticationUtils.isAuthenticated();
    window.isAuthenticated = true;
    Vue.prototype.$isAuthenticated = window.isAuthenticated;
  }

  static checkSession () {
    const prevLogin = AuthenticationUtils.getPrevLogin();
    const time = new Date().valueOf() - prevLogin;
    return prevLogin !== '' ;
  }
}