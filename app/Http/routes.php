<?php

/*----------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', 'HomeController@index');

Route::get('auth/login', [
    'as'   => 'auth.login',
    'uses' => 'Auth\AuthController@getLogin'
]);

Route::post('auth/login', [
    'as'   => 'auth.doLogin',
    'uses' => 'Auth\AuthController@postLogin'
]);

Route::get('auth/logout', [
    'as'   => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

Route::group(['middleware' => 'auth'], function ()
{
    Route::group(['middleware' => 'role:admin', 'prefix' => 'dashboard/protected'], function ()
    {
        Route::get('/', [
            'as'   => 'dashboard.admin',
            'uses' => 'Dashboard\DashboardController@admin'
        ]);
        Route::get('users/settings', [
            'as'   => 'admin.setting',
            'uses' => 'Dashboard\Admin\UserManagementController@setting'
        ]);
        Route::get('users/getUsers', [
            'as'   => 'dashboard.protected.users.getUsers',
            'uses' => 'Dashboard\Admin\UserManagementController@getUsers'
        ]);
        Route::get('users/search/autocomplete', [
            'as'   => 'dashboard.protected.users.autocomplete',
            'uses' => 'Dashboard\Admin\UserManagementController@autocomplete'
        ]);
        Route::get('transactions/getSavings', [
            'as'   => 'dashboard.protected.transactions.getSavings',
            'uses' => 'Dashboard\Admin\SavingController@getSavings'
        ]);
        Route::get('transactions/credit', [
            'as'   => 'dashboard.protected.transactions.credit',
            'uses' => 'Dashboard\Admin\SavingController@credit'
        ]);
        Route::post('transactions/credit', [
            'as'   => 'dashboard.protected.transactions.credit.create',
            'uses' => 'Dashboard\Admin\SavingController@createCredit'
        ]);
        Route::resource('users', 'Dashboard\Admin\UserManagementController');
        Route::resource('categories', 'Dashboard\Admin\CategoryController');
        Route::resource('types', 'Dashboard\Admin\TypeController');
        Route::resource('transactions', 'Dashboard\Admin\SavingController');
    });

    Route::group(['middleware' => 'role:user', 'prefix' => 'dashboard'], function ()
    {
        Route::get('/', [
            'as'   => 'dashboard.user',
            'uses' => 'Dashboard\DashboardController@user'
        ]);
        Route::get('users/settings', [
            'as'   => 'user.setting',
            'uses' => 'Dashboard\User\UserController@setting'
        ]);
        Route::resource('users', 'Dashboard\User\UserController');
    });

    Route::get('files/download/{file_type}/{file_name}', 'DownloadController@getFiles');
});
