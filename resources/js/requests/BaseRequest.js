import Vue from 'vue';
import Toasted from 'vue-toasted';
Vue.use(Toasted);
export default class BaseRequest {
  getUrlPrefix () {
    return '/api';
  }

  async get (url, params = {}, cancelToken) {
    try {
      const config = {
        params,
        cancelToken: cancelToken ? cancelToken.token : undefined,
      };
      const response = await window.axios.get(this.getUrlPrefix('GET') + url, config);
      return this._responseHandler(response);
    } catch (error) {
      this._errorHandler(error);
    }
  }

  async put (url, data = {}) {
    try {
      const response = await window.axios.put(this.getUrlPrefix() + url, data);
      return this._responseHandler(response);
    } catch (error) {
      this._errorHandler(error);
    }
  }

  async post (url, data = {}) {
    try {
      const response = await window.axios.post(this.getUrlPrefix() + url, data);
      return this._responseHandler(response);
    } catch (error) {
      this._errorHandler(error);
    }
  }

  async del (url, data = {}) {
    try {
      const response = await window.axios.delete(this.getUrlPrefix() + url, { data });
      return this._responseHandler(response);
    } catch (error) {
      this._errorHandler(error);
    }
  }

  async _responseHandler (response) {
    const data = response.data;
    return data;
  }


  _errorHandler (err) {
    if(err.response.status == 422) {
      Object.values(err.response.data.errors).forEach(el =>{
        console.log(el);
      	el.forEach(msg => {
          Vue.toasted.show(msg, {
            theme: 'bubble',
            position: 'top-right',
            duration : 1500,
            type: 'danger'
          });
        });
      });
    }

    if (err.message === 'Network Error' && err.response && err.response.status === 503) {
      Vue.prototype.$isMaintenanceMode = true;
      window.app.$broadcast('MaintenanceSetting', 1);
    }
    window.app.$broadcast('EVENT_COMMON_ERROR', err);
    if (err.response && err.response.status === 401) { // Unauthorized (session timeout)
      window.app.$modal.show('warning-login-dialog');
    }
    if (err.response && err.response.status === 503) { // maintenance
      window.location.reload();
    }
    throw err;
  }

}
