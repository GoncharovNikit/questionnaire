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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/questionnaires/create', 'QuestionnaireController@create')->name('quest.create');
Route::post('/questionnaires', 'QuestionnaireController@store')->name('quest.store');
Route::get('/questionnaires', function(){
    return redirect()->route('home');
});
Route::get('/questionnaires/{questionnaire}', 'QuestionnaireController@show')->name('quest.show');

Route::get('/questionnaires/{questionnaire}/questions/create', 'QuestionController@create')->name('question.create');
Route::post('/questionnaires/{questionnaire}/questions', 'QuestionController@store')->name('question.store');
Route::delete('/questionnaires/{questionnaire}/questions/{question}', 'QuestionController@destroy')->name('question.delete');

Route::get('/surveys/{questionnaire}-{slug}', 'SurveyController@show')->name('survey.show');
Route::post('/surveys/{questionnaire}-{slug}', 'SurveyController@store')->name('survey.store');