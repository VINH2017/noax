<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FlagController;
use App\Http\Controllers\ReportController;
use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'auth'], function ($api) {
        $api->post('login', AuthenticationController::class . '@authenticate');
    });
    $api->get('count/{url}', ReportController::class . '@reports');
    $api->resource('reports', ReportController::class);
    $api->resource('flags', FlagController::class);
});