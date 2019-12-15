import UserRequest from './UserRequest';
import StudentRequest from './StudentRequest';
import ExamSessionRequest from './ExamSessionRequest';
import UniversityRequest from './UniversityRequest';
import RoomRequest from './RoomRequest';
import ModuleRequest from './ModuleRequest';
import TestRoomRequest from './TestRoomRequest';
import ExamRequest from './ExamRequest';
import TestSiteRequest from './TestSiteRequest';
const requestMap = {
  UserRequest,
  StudentRequest,
  ExamSessionRequest,
  UniversityRequest,
  RoomRequest,
  ModuleRequest,
  TestRoomRequest,
  ExamRequest,
  TestSiteRequest
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
