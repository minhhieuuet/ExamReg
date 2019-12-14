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

  getAllStudentsInModule(moduleId) {
    return this.get('/admin/module/all-students/' + moduleId);
  }

  removeOneStudentFromModule(moduleId, studentId) {
    const url ='/admin/module/remove-one-student';
    return this.post(url, {module_id: moduleId, student_id: studentId});
  }

  getAllStudentsToAdd(moduleId) {
    const url = '/admin/module/all-students-to-add/'+ moduleId;
    return this.get(url);
  }

  addStudentsToModule(ids, moduleId) {
    const url = '/admin/module/add-students';
    return this.post(url, {ids: ids, module_id: moduleId});
  }
}
