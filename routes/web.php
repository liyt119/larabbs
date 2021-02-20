<?php

Route::get('/', 'PagesController@root')->name('root');



Auth::routes(['verify' => true]);

Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

Route::resource('topics', 'TopicsController', ['only' => ['index',  'create', 'store', 'update', 'edit', 'destroy']]);

Route::resource('categories','CategoriesController',['only'=>['show']]);

Route::post('upload_image','TopicsController@uploadImage')->name('topics.upload_image');
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

Route::resource('replies', 'RepliesController', ['only' => [ 'store',  'destroy']]);

Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
