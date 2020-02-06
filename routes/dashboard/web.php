<?php

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:super_admin|admin'])->group(function (){
    Route::get('/','WelcomeController@index')->name('welcome');

    Route::resource('categories', 'CategoryController')->except('show');

    Route::resource('roles', 'RoleController')->except('show');

    Route::resource('users', 'UserController')->except('show');

    Route::resource('movies', 'MovieController');

    Route::get('/setting/social_login', 'SettingController@social_login')->name('settings.social_login');
    Route::get('/setting/social_links', 'SettingController@social_links')->name('settings.social_links');
    Route::post('/settings', 'SettingController@store')->name('settings.store');
});
