<?php

Route::get('/', 'SurveyController@home')->name('home.page');
Route::auth();