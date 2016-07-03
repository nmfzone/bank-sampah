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

/*
 * Not Used
 *
Route::get('auth/register', [
    'as'   => 'auth.register',
    'uses' => 'Auth\AuthController@getRegistration'
]);

Route::post('auth/register', [
    'as'   => 'auth.doRegister',
    'uses' => 'Auth\AuthController@postRegistration'
]);

Route::get('auth/emails/verify/{code}', [
    'as'   => 'auth.emails.verify',
    'uses' => 'Auth\AuthController@verifyEmailActivationCode'
]);
*/

Route::group(['middleware' => 'auth'], function ()
{
    Route::group(['middleware' => 'role:admin', 'prefix' => 'dashboard/protected'], function ()
    {
        Route::get('/', [
            'as'   => 'dashboard.admin',
            'uses' => 'Dashboard\DashboardController@admin'
        ]);
        Route::resource('categories', 'Dashboard\Admin\CategoryController');
        Route::resource('types', 'Dashboard\Admin\TypeController');
        Route::group(['prefix' => 'users'], function ()
        {
            Route::get('settings', [
                'as'   => 'admin.setting',
                'uses' => 'Dashboard\Admin\UserManagementController@setting'
            ]);
            Route::get('getUsers', [
                'as'   => 'dashboard.protected.users.getUsers',
                'uses' => 'Dashboard\Admin\UserManagementController@getUsers'
            ]);
            Route::get('search/autocomplete', [
                'as'   => 'dashboard.protected.users.autocomplete',
                'uses' => 'Dashboard\Admin\UserManagementController@autocomplete'
            ]);
        });
        Route::resource('users', 'Dashboard\Admin\UserManagementController');
        Route::group(['prefix' => 'transactions'], function ()
        {
            Route::get('/', [
                'as'   => 'dashboard.protected.transactions.index',
                'uses' => 'Dashboard\Admin\SavingController@indexSavings'
            ]);
            Route::delete('/{savings}', [
                'as'   => 'dashboard.protected.transactions.destroy',
                'uses' => 'Dashboard\Admin\SavingController@destroySavings'
            ]);
            Route::get('temporaries/getSavingsTemp', [
                'as'   => 'dashboard.protected.transactions.temporaries.getSavingsTemp',
                'uses' => 'Dashboard\Admin\SavingController@getSavingsTemp'
            ]);
            Route::get('getSavings', [
                'as'   => 'dashboard.protected.transactions.getSavings',
                'uses' => 'Dashboard\Admin\SavingController@getSavings'
            ]);
            Route::get('credit', [
                'as'   => 'dashboard.protected.transactions.credit.index',
                'uses' => 'Dashboard\Admin\SavingController@credit'
            ]);
            Route::post('credit', [
                'as'   => 'dashboard.protected.transactions.credit.create',
                'uses' => 'Dashboard\Admin\SavingController@createCredit'
            ]);
            Route::post('synchronize-specific', [
                'as'   => 'dashboard.protected.transactions.sync.specific',
                'uses' => 'Dashboard\Admin\SavingController@synchronizeSpecificUser'
            ]);
            Route::post('synchronize-all', [
                'as'   => 'dashboard.protected.transactions.sync.all',
                'uses' => 'Dashboard\Admin\SavingController@synchronizeAllUser'
            ]);
            Route::post('unsynchronize-specific', [
                'as'   => 'dashboard.protected.transactions.unsync.specific',
                'uses' => 'Dashboard\Admin\SavingController@unsynchronizeSpecificUser'
            ]);
            Route::post('unsynchronize-all', [
                'as'   => 'dashboard.protected.transactions.unsync.all',
                'uses' => 'Dashboard\Admin\SavingController@unsynchronizeAllUser'
            ]);
            Route::resource('temporaries', 'Dashboard\Admin\SavingController');
        });
        Route::group(['prefix' => 'recapitulations'], function ()
        {
            Route::get('/', [
                'as'   => 'dashboard.protected.recapitulations.index',
                'uses' => 'Dashboard\Admin\RecapitulationController@index'
            ]);
            Route::post('/', [
                'as'   => 'dashboard.protected.recapitulations.create',
                'uses' => 'Dashboard\Admin\RecapitulationController@create'
            ]);
            Route::get('getRecapitulation', [
                'as'   => 'dashboard.protected.recapitulations.getRecapitulation',
                'uses' => 'Dashboard\Admin\RecapitulationController@getRecapitulation'
            ]);
        });
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
