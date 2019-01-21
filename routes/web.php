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



Route::middleware(['isadmin'])->group(function () {
    //Mettre  les routes accessibles par les admins
    Route::resource('users', 'UserController');
});

Route::get('/', 'WelcomeController@index')->name('Welcome');

Route::prefix('Professeur')->middleware(['isteacher'])->group(function () {
    Route::get('Tableau-de-bord', 'TeacherController@index')->name('dashboardTeacher');
    Route::get('Creation-classe', 'TeacherController@create')->name('creation-classe');
    Route::post('storeClassroom', 'TeacherController@store');
    Route::get('Import-nom-eleves', 'TeacherController@ImportNameForm')->name('Import-nom-eleves');
    Route::post('affichage-eleves', 'TeacherController@ImportName');
    Route::get('Tableau-de-bord/{id}/showResults', 'TeacherController@showResults');
    Route::get('csv', 'CsvController@index')->name('csv');
    Route::post('csv', 'CsvController@postForm');
    Route::get('exportData', 'TeacherController@exportData');
    Route::delete('Suppression-eleves/{id}', 'TeacherController@deleteStudent')->name('suppression-eleves');
});

Route::prefix('Eleves')->group(function() {
    Route::get('/login', 'Auth\StudentLoginController@showLoginForm')->name('student.login');
    Route::post('/login', 'Auth\StudentLoginController@login')->name('student.login.submit');
    Route::get('logout/', 'Auth\StudentLoginController@logout')->name('student.logout');
    Route::get('Tableau-de-bord', 'StudentInterfaceController@index')->name('student.dashboard');
    Route::post('Tableau-de-bord', 'StudentInterfaceController@postForm');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

