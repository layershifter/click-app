<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('click', 'ClickController@store');
Route::get('click/error/{click}', 'ClickController@error');
Route::get('click/success/{click}', 'ClickController@success');
