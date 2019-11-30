import UserRequest from './UserRequest';
import StudentRequest from './StudentRequest';
import ExamSessionRequest from './ExamSessionRequest';
const requestMap = {
  UserRequest,
  StudentRequest,
  ExamSessionRequest
};

const instances = {};

export default class RequestFactory {

  static getRequest (classname) {
    const RequestClass = requestMap[classname];
    if (!RequestClass) {
      throw new Error(`Invalid request class name: ${classname}`);
    }

    let requestInstance = instances[classname];
    if (!requestInstance) {
      requestInstance = new RequestClass();
      instances[classname] = requestInstance;
    }

    return requestInstance;
  }

}
