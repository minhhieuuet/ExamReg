<?php
use Illuminate\Http\Request;
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'admin'], function () {
      Route::get('/students', 'StudentController@getStudents');
      Route::get('student/{student}', 'StudentController@getOneStudent');
      Route::post('student', 'StudentController@storeStudent');
      Route::put('student/{student}', 'StudentController@updateStudent');
      Route::delete('student/{student}', 'StudentController@deleteOneStudent');
      Route::delete('many-students', 'StudentController@deleteManyStudent');
});
