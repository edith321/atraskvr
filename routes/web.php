<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/languages', ['uses' => 'helpers@getActiveLanguages']);

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'AdminRestriction']], function () {

    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', ['as' => 'app.menu.index', 'uses' => 'VrMenuController@index']);
        Route::get('/create', ['as' => 'app.menu.create', 'uses' => 'VrMenuController@create']);
        Route::post('/create', ['uses' => 'VrMenuController@store']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.menu.show', 'uses' => 'VrMenuController@show']);
            Route::get('/edit', ['as' => 'app.menu.edit', 'uses' => 'VrMenuController@edit']);
            Route::post('/edit', ['uses' => 'VrMenuController@update']);
            Route::delete('/delete', ['as' => 'app.menu.destroy', 'uses' => 'VrMenuController@destroy']);
        });
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', ['as' => 'app.orders.index', 'uses' => 'VrOrderController@index']);
        Route::get('/create', ['as' => 'app.orders.create', 'uses' => 'VrOrderController@create']);
        Route::post('/create', ['uses' => 'VrOrderController@store']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.orders.show', 'uses' => 'VrOrderController@show']);
            Route::get('/edit', ['as' => 'app.orders.edit', 'uses' => 'VrOrderController@edit']);
            Route::post('/edit', ['uses' => 'VrOrderController@update']);
            Route::delete('/delete', ['as' => 'app.orders.destroy', 'uses' => 'VrOrderController@destroy']);
        });
    });
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', ['as' => 'app.pages.index', 'uses' => 'VrPagesController@index']);
        Route::get('/create', ['as' => 'app.pages.create', 'uses' => 'VrPagesController@create']);
        Route::post('/create', ['uses' => 'VrPagesController@store']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.pages.show', 'uses' => 'VrPagesController@show']);
            Route::get('/edit', ['as' => 'app.pages.edit', 'uses' => 'VrPagesController@edit']);
            Route::post('/edit', ['uses' => 'VrPagesController@update']);
            Route::delete('/delete', ['as' => 'app.pages.destroy', 'uses' => 'VrPagesController@destroy']);
        });
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', ['as' => 'app.categories.index', 'uses' => 'VrCategoriesController@index']);
        Route::get('/create', ['as' => 'app.categories.create', 'uses' => 'VrCategoriesController@create']);
        Route::post('/create', ['uses' => 'VrCategoriesController@store']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.categories.show', 'uses' => 'VrCategoriesController@show']);
            Route::get('/edit', ['as' => 'app.categories.edit', 'uses' => 'VrCategoriesController@edit']);
            Route::post('/edit', ['uses' => 'VrCategoriesController@update']);
            Route::delete('/delete', ['as' => 'app.categories.destroy', 'uses' => 'VrCategoriesController@destroy']);
        });
    });
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', ['as' => 'app.languages.index', 'uses' => 'VrLanguageCodesController@index']);
        Route::get('/create', ['as' => 'app.languages.create', 'uses' => 'VrLanguageCodesController@create']);
        Route::post('/create', ['uses' => 'VrLanguageCodesController@store']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.languages.show', 'uses' => 'VrLanguageCodesController@show']);
            Route::get('/edit', ['as' => 'app.languages.edit', 'uses' => 'VrLanguageCodesController@edit']);
            Route::post('/edit', ['uses' => 'VrLanguageCodesController@update']);
            Route::delete('/delete', ['as' => 'app.languages.destroy', 'uses' => 'VrLanguageCodesController@destroy']);
        });
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['as' => 'app.users.index', 'uses' => 'VrUsersController@index']);
        Route::get('/create', ['as' => 'app.users.create', 'uses' => 'VrUsersController@create']);
        Route::post('/create', ['uses' => 'VrUsersController@store']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.users.show', 'uses' => 'VrUsersController@show']);
            Route::get('/edit', ['as' => 'app.users.edit', 'uses' => 'VrUsersController@edit']);
            Route::post('/edit', ['uses' => 'VrUsersController@update']);
            Route::delete('/delete', ['as' => 'app.users.destroy', 'uses' => 'VrUsersController@destroy']);
            Route::get('/orders', ['as' => 'app.users.orders', 'uses' => 'VrUsersController@orderIndex']);
        });
    });
    Route::group(['prefix' => 'resources'], function () {
        Route::get('/', ['as' => 'app.resources.index', 'uses' => 'VrResourcesController@index']);
        Route::get('/create', ['as' => 'app.resources.create', 'uses' => 'VrResourcesController@create']);
        Route::post('/create', ['uses' => 'VrResourcesController@store']);
        Route::group(['prefix' => '{id}'], function () {
            Route::get('/', ['as' => 'app.resources.show', 'uses' => 'VrResourcesController@show']);
            Route::get('/edit', ['as' => 'app.resources.edit', 'uses' => 'VrResourcesController@edit']);
            Route::post('/edit', ['uses' => 'VrResourcesController@update']);
            Route::delete('/delete', ['as' => 'app.resources.destroy', 'uses' => 'VrResourcesController@destroy']);
            Route::get('/orders', ['as' => 'app.resources.orders', 'uses' => 'VrResourcesController@orderIndex']);
        });
    });
});

