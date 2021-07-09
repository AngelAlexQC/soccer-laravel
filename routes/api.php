<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Club
    Route::apiResource('clubs', 'ClubApiController');

    // Category
    Route::apiResource('categories', 'CategoryApiController');

    // Championship
    Route::apiResource('championships', 'ChampionshipApiController');

    // Enrollment
    Route::apiResource('enrollments', 'EnrollmentApiController');

    // Match
    Route::apiResource('matches', 'MatchApiController');

    // Event
    Route::apiResource('events', 'EventApiController');
});
