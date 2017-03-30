<?php

Route::get('/', 'SurveyController@home')->name('home.page');
Route::get('/', 'MyController@home')->name('home.page');
Route::get('/survey/view/{survey}', 'SurveyController@view_survey')->name('view.survey');
Route::auth();