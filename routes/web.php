<?php

Route::get('/', 'ClickController@index');
Route::get('click', 'ClickController@store');
Route::get('click/error/{click}', 'ClickController@error');
Route::get('click/success/{click}', 'ClickController@success');

Route::get('domains', 'BadDomainController@index');
Route::post('domains', 'BadDomainController@store');
Route::get('domains/create', 'BadDomainController@create');