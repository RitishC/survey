<?php

Route::get('/', 'SurveyController@home')->name('home.page');
Route::get('/', 'MyController@home')->name('home.page');
Route::auth();