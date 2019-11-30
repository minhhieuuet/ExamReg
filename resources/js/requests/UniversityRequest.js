import BaseModelRequest from './BaseModelRequest';

export default class UniversityRequest extends BaseModelRequest {
  getUniversities(params) {
    const url = '/admin/universities';
    return this.get(url, params);
  }

  store(params) {

    const url = '/admin/university';

    return this.post(url, params);
  }

  show(universityId) {
    const url = '/admin/university/' + universityId;
    return this.get(url);
  }

  update(universityId, params) {
    const url = '/admin/university/' + universityId;
    return this.put(url, params);
  }

  removeOneUniversity(universityId) {
    const url = '/admin/university/' + universityId;
    return this.del(url);
  }

  removeManyUniversities(universityIds) {
    const url = '/admin/many-universities';
    return this.del(url, {ids: universityIds});
  }

}
