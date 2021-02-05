<?php

Route::get('/', 'PagesController@root')->name('root');



Auth::routes(['verify' => true]);

Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

Route::resource('topics', 'TopicsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::resource('categories','CategoriesController',['only'=>['show']]);
