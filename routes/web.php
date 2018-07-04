<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 // API
 Route::group(array('prefix' => 'rest'), function() {
//   // - Config
//   Route::get('/config', 'ApiConfigController@getConfig');

  // // - General
  // Route::get('/stat', 'ApiGeneralController@getStat');
  // Route::put('/change-password', 'ApiUserController@putChangePassword');

  // Route::group(array('prefix' => 'answer'), function() {
  //   Route::get('/list', 'ApiGeneralController@getAnswerSheetList');
  //   Route::post('/create', 'ApiAnswerSheetController@postCreateAnswerSheet');
  //   Route::put('/update', 'ApiAnswerSheetController@putUpdateAnswerSheet');
  // });

  // Route::group(array('prefix' => 'user'), function() {
  //   // - User
  //   Route::get('/list', 'ApiUserController@getUserList');
  //   Route::put('/status', 'ApiUserController@putUserStatus');
  //   Route::post('/create', 'ApiUserController@postCreateUser');
  // });

  // // Survey
  // Route::get('/survey', 'ApiSurveyController@getSurvey');
  // Route::get('/answer', 'ApiAnswerSheetController@getAnswerSheet');

  // // Address
  // Route::group(array('prefix' => 'address'), function() {
  //   Route::get('/amphur', 'ApiAddressController@getAmphur');
  //   Route::get('/district', 'ApiAddressController@getDistrict');
  // });

  // // Report
  // Route::group(array('prefix' => 'report'), function() {
  //   Route::get('/percent', 'ApiReportController@getPercent');
  //   Route::get('/generated/raws', 'ApiReportController@getRaws');
  // });
});

// API
Route::group(array('prefix' => 'api'), function() {
  Route::get('/pressure', 'ApiController@getPressure');
  // Route::get('/seismic', 'ApiController@getSeismic');
});

// React Web
Route::get( '/{any}', 'RduController@reactPage')->where('any', '.*');

// Route::group(array('middleware' => 'ndsNonAuthen'), function() {
//   Route::get('/', 'RduController@loginPage');
//   Route::post('/login', 'RduController@doLogin');
// });

// Route::group(array('middleware' => 'ndsAuthen'), function() {
//   // Base Operation
//   Route::get('/logout', 'RduController@doLogout');

//   // API
//   Route::group(array('prefix' => 'rest'), function() {
//     // - Config
//     Route::get('/config', 'ApiConfigController@getConfig');

//     // - General
//     Route::get('/stat', 'ApiGeneralController@getStat');
//     Route::put('/change-password', 'ApiUserController@putChangePassword');

//     Route::group(array('prefix' => 'answer'), function() {
//       Route::get('/list', 'ApiGeneralController@getAnswerSheetList');
//       Route::post('/create', 'ApiAnswerSheetController@postCreateAnswerSheet');
//       Route::put('/update', 'ApiAnswerSheetController@putUpdateAnswerSheet');
//     });

//     Route::group(array('prefix' => 'user'), function() {
//       // - User
//       Route::get('/list', 'ApiUserController@getUserList');
//       Route::put('/status', 'ApiUserController@putUserStatus');
//       Route::post('/create', 'ApiUserController@postCreateUser');
//     });

//     // Survey
//     Route::get('/survey', 'ApiSurveyController@getSurvey');
//     Route::get('/answer', 'ApiAnswerSheetController@getAnswerSheet');

//     // Address
//     Route::group(array('prefix' => 'address'), function() {
//       Route::get('/amphur', 'ApiAddressController@getAmphur');
//       Route::get('/district', 'ApiAddressController@getDistrict');
//     });

//     // Report
//     Route::group(array('prefix' => 'report'), function() {
//       Route::get('/percent', 'ApiReportController@getPercent');
//       Route::get('/generated/raws', 'ApiReportController@getRaws');
//     });
//   });

//   // React Web
//   Route::get( '/{any}', 'RduController@reactPage')->where('any', '.+');
// });
