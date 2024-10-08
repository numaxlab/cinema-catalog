<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array)config('backpack.base.web_middleware', 'web'),
        (array)config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'NumaxLab\CinemaCatalog\Http\Controllers\Backpack',

], function () { // custom admin routes
    Route::crud('project', 'ProjectCrudController');
    Route::crud('cinema', 'CinemaCrudController');
    Route::crud('session', 'SessionCrudController');
    Route::crud('film-mmaker', 'FilmMakerCrudController');
    Route::crud('project_collection', 'ProjectCollectionCrudController');
}); // this should be the absolute last line of this file
