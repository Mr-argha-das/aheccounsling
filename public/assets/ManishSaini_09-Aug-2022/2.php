<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
	
    $router->get('/', 'HomeController@index')->name('home');
     $router->resource('mediafile', MediaController::class);
    $router->resource('blogs', BlogController::class);
    $router->resource('blog-category', BlogCategoryController::class);
    $router->resource('job-posting', JobPostingController::class);
    $router->resource('contact-enquiry', ContactusController::class);
    $router->resource('job-apply', JobAppliedController::class);

 });
