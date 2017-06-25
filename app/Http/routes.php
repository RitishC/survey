<?php
Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'SurveyController@home');

	Route::get('/survey/new', 'SurveyController@new_survey')->name('new.survey');
    Route::get('/survey/{survey}', 'SurveyController@detail_survey')->name('detail.survey');
    Route::get('/survey/questions/categories', 'SurveyController@get_question_categories')->name('detail.question_categories');
	Route::get('/export-survey/{question}', 'SurveyController@export_answers')->name('export.survey');
	Route::get('/survey/view/{survey}', 'SurveyController@view_survey')->name('view.survey');
	Route::get('/survey/answers/{survey}', 'SurveyController@view_survey_answers')->name('view.survey.answers');
	Route::get('/survey/{survey}/delete', 'SurveyController@delete_survey')->name('delete.survey');

	Route::get('/survey/{survey}/edit', 'SurveyController@edit')->name('edit.survey');
	Route::patch('/survey/{survey}/update', 'SurveyController@update')->name('update.survey');
	Route::post('/survey/create', 'SurveyController@create')->name('create.survey');

	// Questions related
	Route::post('/survey/{survey}/questions', 'QuestionController@store')->name('store.question');
	Route::get('/question/{question}/edit', 'QuestionController@edit')->name('edit.question');
	Route::patch('/question/{question}/update', 'QuestionController@update')->name('update.question');
	Route::get('/question/{question}/delete', 'QuestionController@delete_question')->name('delete.survey');
});

Route::auth();
//routes voor url/link
Route::get('/url_survey/{hash}/', 'SurveyController@show_protected_survey')->name('survey.protected');
Route::get('/thankyou_page', 'SurveyController@thankyou_page')->name('survey.thankyou');
Route::post('/survey/view/{survey}/completed', 'AnswerController@store')->name('complete.survey');

Route::get('/survey/{survey}/user', 'SurveyController@detail_survey_user')->name('detail.survey.user');
Route::get('/user', 'SurveyController@detail_overview_user')->name('overview.survey.user');