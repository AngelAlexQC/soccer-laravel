<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Players
    Route::delete('players/destroy', 'PlayerController@massDestroy')->name('players.massDestroy');
    Route::resource('players', 'PlayerController');

    // Club
    Route::delete('clubs/destroy', 'ClubController@massDestroy')->name('clubs.massDestroy');
    Route::post('clubs/media', 'ClubController@storeMedia')->name('clubs.storeMedia');
    Route::post('clubs/ckmedia', 'ClubController@storeCKEditorImages')->name('clubs.storeCKEditorImages');
    Route::resource('clubs', 'ClubController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Championship
    Route::delete('championships/destroy', 'ChampionshipController@massDestroy')->name('championships.massDestroy');
    Route::resource('championships', 'ChampionshipController');
    Route::get('generate/{championship}', 'ChampionshipController@generate')->name('championships.generate');
    // Enrollment
    Route::delete('enrollments/destroy', 'EnrollmentController@massDestroy')->name('enrollments.massDestroy');
    Route::resource('enrollments', 'EnrollmentController');

    // Match
    Route::delete('matches/destroy', 'MatchController@massDestroy')->name('matches.massDestroy');
    Route::resource('matches', 'MatchController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Club
    Route::delete('clubs/destroy', 'ClubController@massDestroy')->name('clubs.massDestroy');
    Route::post('clubs/media', 'ClubController@storeMedia')->name('clubs.storeMedia');
    Route::post('clubs/ckmedia', 'ClubController@storeCKEditorImages')->name('clubs.storeCKEditorImages');
    Route::resource('clubs', 'ClubController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Championship
    Route::delete('championships/destroy', 'ChampionshipController@massDestroy')->name('championships.massDestroy');
    Route::resource('championships', 'ChampionshipController');

    // Enrollment
    Route::delete('enrollments/destroy', 'EnrollmentController@massDestroy')->name('enrollments.massDestroy');
    Route::resource('enrollments', 'EnrollmentController');

    // Match
    Route::delete('matches/destroy', 'MatchController@massDestroy')->name('matches.massDestroy');
    Route::resource('matches', 'MatchController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
