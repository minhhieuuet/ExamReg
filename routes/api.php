<?php

use Illuminate\Http\Request;

/* Login */
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => ['auth:api']
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group(['middleware' => ['auth:api', 'isAdmin'], 'prefix' => 'admin'], function () {
    /* Admin 4 */
    // Route::get('/test-rooms', 'TestRoomController@getTestRooms');
    // Route::get('test-room/{testRoom}', 'TestRoomController@getOneTestRoom');
    // Route::post('test-room', 'TestRoomController@storeTestRoom');
    // Route::put('test-room/{testRoom}', 'TestRoomController@updateTestRoom');
    // Route::delete('test-room/{testRoom}', 'TestRoomController@deleteOneTestRoom');
    // Route::delete('many-test-rooms', 'TestRoomController@deleteManyTestRooms');

    /* Admin 5 */
    // Route::get('/test-sites', 'TestSiteController@getTestSites');
    // Route::get('test-site/{testSite}', 'TestSiteController@getOneTestSite');
    // Route::post('test-site', 'TestSiteController@storeTestSite');
    // Route::put('test-site/{testSite}', 'TestSiteController@updateTestSite');
    // Route::delete('test-site/{testSite}', 'TestSiteController@deleteOneTestSite');
    // Route::delete('many-test-sites', 'TestSiteController@deleteManyTestSites');

    /* Admin 6 */
    // Route::get('/exams', 'ExamController@getExams');
    // Route::get('exam/{exam}', 'ExamController@getOneExam');
    // Route::post('exam', 'ExamController@storeExam');
    // Route::put('exam/{exam}', 'ExamController@updateExam');
    // Route::delete('exam/{exam}', 'ExamController@deleteOneExam');
    // Route::delete('many-exams', 'ExamController@deleteManyExams');

    /* Admin 7 */
    Route::get('/students', 'StudentController@getStudents');
    Route::get('student/{student}', 'StudentController@getOneStudent');
    Route::post('student', 'StudentController@storeStudent');
    Route::put('student/{student}', 'StudentController@updateStudent');
    Route::delete('student/{student}', 'StudentController@deleteOneStudent');
    Route::delete('many-students', 'StudentController@deleteManyStudents');

    /* Admin 8 */
    Route::get('/modules', 'ModuleController@getModules');
    Route::get('module/{module}', 'ModuleController@getOneModule');
    Route::post('module', 'ModuleController@storeModule');
    Route::put('module/{module}', 'ModuleController@updateModule');
    Route::delete('module/{module}', 'ModuleController@deleteOneModule');
    Route::delete('many-modules', 'ModuleController@deleteManyModules');

    /* Admin 9 */
    Route::get('/rooms', 'RoomController@getRooms');
    Route::get('room/{room}', 'RoomController@getOneRoom');
    Route::post('room', 'RoomController@storeRoom');
    Route::put('room/{room}', 'RoomController@updateRoom');
    Route::delete('room/{room}', 'RoomController@deleteOneRoom');
    Route::delete('many-rooms', 'RoomController@deleteManyRooms');

    /* Admin 10 */
    Route::get('/universities', 'UniversityController@getUniversities');
    Route::get('university/{university}', 'UniversityController@getOneUniversity');
    Route::post('university', 'UniversityController@storeUniversity');
    Route::put('university/{university}', 'UniversityController@updateUniversity');
    Route::delete('university/{university}', 'UniversityController@deleteOneUniversity');
    Route::delete('many-universities', 'UniversityController@deleteManyUniversities');

    /* Admin 3 */
    Route::get('/exam-sessions', 'ExamSessionController@getExamSessions');
    Route::get('exam-session/{examSession}', 'ExamSessionController@getOneExamSession');
    Route::get('all-module', 'ExamSessionController@getAllModules');
    Route::get('all-testSites', 'ExamSessionController@getAllTestSites');
    Route::post('exam-session', 'ExamSessionController@storeExamSession');
    Route::put('exam-session/{examSession}', 'ExamSessionController@updateExamSession');
    Route::delete('exam-session/{examSession}', 'ExamSessionController@deleteOneExamSession');
    Route::delete('many-exam-sessions', 'ExamSessionController@deleteManyExamSessions');
});

Route::group(['middleware' => ['auth:api', 'isAdminOrSelf'], 'prefix' => 'user'], function () {
    Route::get('/all-modules', 'ClientController@getAllModules');
    Route::get('/all-exam-sessions/{module}', 'ClientController@getAllModuleExamSessions');
    Route::get('/all-registed-sessions', 'ClientController@getAllRegistedSessions');
    Route::get('/all-registed-sessions-np', 'ClientController@getAllRegistedSessionsNp');
    Route::get('/exam-session-computers/{examSession}', 'ClientController@totalExamSessionComputers');
    Route::get('/exam-session-registed-computers/{examSession}', 'ClientController@totalExamSessionRegistedComputers');
    Route::post('/register-session', 'ClientController@registerSession');
    Route::post('/unregister-session', 'ClientController@unRegisterASession');
    Route::get('/is-registed-module/{module}', 'ClientController@isRegistedModule');
});
