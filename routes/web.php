<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('cvs', 'CvController@index');
Route::get('cvs/create', 'CvController@create');
Route::post('cvs', 'CvController@store');
Route::get('cvs/{id}/edit', 'CvController@edit');
Route::put('cvs/{id}', 'CvController@update');
Route::delete('cvs/{id}', 'CvController@destroy');*/
Route::resource('cvs', 'CvController');

//Route correspond au module experience
Route::get('/getdata/{id}', 'CvController@getData');
Route::post('/addexperience', 'CvController@addExperience');
Route::put('/updateexperience', 'CvController@updateExperience');
Route::delete('/deleteexperience/{id}', 'CvController@deleteExperience');

//Route correspond au module tranings
Route::post('/addtraning', 'CvController@addTraning');
Route::put('/updatetraning', 'CvController@updateTraning');
Route::delete('/deletetraning/{id}', 'CvController@deleteTraning');

//Route correspond au module Skills
Route::post('/addskill', 'CvController@addSkill');
Route::put('/updateskill', 'CvController@updateSkill');
Route::delete('/deleteskill/{id}', 'CvController@deleteSkill');

//Route correspond au module project
Route::post('/addproject', 'CvController@addProject');
Route::put('/updateproject', 'CvController@updateProject');
Route::delete('/deleteproject/{id}', 'CvController@deleteProject');






//Route::get('experience/{id}', 'ExperienceController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
