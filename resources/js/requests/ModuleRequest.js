import BaseModelRequest from './BaseModelRequest';

export default class ModuleRequest extends BaseModelRequest {
  getModules(params) {
    const url = '/admin/modules';
    return this.get(url, params);
  }

  store(params) {

    const url = '/admin/module';

    return this.post(url, params);
  }

  show(moduleId) {
    const url = '/admin/module/' + moduleId;
    return this.get(url);
  }

  update(moduleId, params) {
    const url = '/admin/module/' + moduleId;
    return this.put(url, params);
  }

  removeOneModule(moduleId) {
    const url = '/admin/module/' + moduleId;
    return this.del(url);
  }

  removeManyModules(moduleIds) {
    const url = '/admin/many-modules';
    return this.del(url, {ids: moduleIds});
  }

}
