import BaseRequest from './BaseRequest';

export default class BaseModelRequest extends BaseRequest {

  getModelName () {
    throw new Error('This method should be implemented in derived method.');
  }

  getOne (id, params) {
    const url = `/${this.getModelName()}/${id}`;
    return this.get(url, params);
  }

  getList (params) {
    const url = `/${this.getModelName()}`;
    return this.get(url, params);
  }

  createANewOne (data) {
    const url = `/${this.getModelName()}`;
    return this.post(url, data);
  }

  updateOne (id, data) {
    const url = `/${this.getModelName()}/${id}`;
    return this.put(url, data);
  }

  removeOne (id) {
    const url = `/${this.getModelName()}/${id}`;
    return this.del(url);
  }
}
