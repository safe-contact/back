<?php

use Illuminate\Support\Facades\Route;

Route::post('diagnostic', 'User\UserController@diagnostic');

Route::post('safe', 'User\UserController@safe');

Route::post('recovered', 'User\UserController@recovered');

Route::post('symptom', 'User\UserController@symptom');

Route::post('meeted', 'Meet\MeetController@create');
