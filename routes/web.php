<?php

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Route to homepage
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('homepage');
Route::get('/home/events', 'HomeController@events');

// verification of the email upon registration
// this also identifies the user as validated
Route::get('/verify/{verifyToken}', 'VerifyController@verify')->name('verify');

// Route to about us page
Route::get('/aboutus', 'AboutusController@aboutus');
Route::get('/about', 'AboutusController@aboutus');

// validated routers for users with a diary
Route::middleware('validate')->group(function () {
  // Routes to do show, search in or create event in calendar
  Route::get('/home/create_event', 'EventController@create');
  Route::post('/home/store_event', 'EventController@store');
  Route::get('/home/search', 'EventController@search');
  Route::get('/home/edit_event', 'EventController@edit');
  Route::get('/home/mycalendar', 'EventController@index');

  ////// DIARY ENTRY PAGE DIRECTION //////
  // Redirects to the create diary entry page
  Route::get('/entries', 'Entry\EntryController@create')->name('home');
  // Page to store diary entries
  Route::post('/entries/create_entry', 'Entry\EntryController@store');
  // Page to create and store user made illness
  Route::post('/entries/create_illness', 'Entry\IllnessController@store');
  // Page to create and store symptom
  Route::post('/entries/create_symptom', 'Entry\SymptomController@store');

  // Route to diary overview page
  Route::get('/overview', 'OverviewController@index');
  Route::get('/overview/search', 'OverviewController@search');
  Route::get('/overview/sortillness', 'OverviewController@sortillness');
  Route::get('/overview/sortintensity', 'OverviewController@sortintensity');
  Route::get('/overview/chronological', 'OverviewController@chronological');

  // Route to export page
  Route::get('/export', 'ExportController@index');
  Route::post('/export/period', 'ExportController@exportperiod');
  Route::post('/export/illness', 'ExportController@exportillness');
  Route::post('/export/getillnessPDF', 'ExportController@getillnessPDF');
  Route::post('/export/getdatePDF', 'ExportController@getperiodPDF');
  Route::post('/export/getPDF', 'ExportController@getPDF');

  // Route to account page
  Route::get('/account', 'AccountController@index');
  Route::get('/account/edit', 'AccountController@edit');
  Route::post('/account/edit', 'AccountController@update');

  // Route to new themes
  Route::get('account/theme_contrast', 'ThemeController@update_contrast');
  Route::get('account/theme_vrolijk', 'ThemeController@update_vrolijk');
  Route::get('account/theme_default', 'ThemeController@update');

});

// validated routers for readers
Route::middleware('can:read-diary')->group(function () {
  Route::get('/reader/login', 'ReaderController@login')
  ->name('reader_login');

  Route::get('/reader/diary', 'ReaderController@show')
  ->name('reader_diary');
});
