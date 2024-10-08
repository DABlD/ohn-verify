<?php

use Illuminate\Support\Facades\Route;

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

//JUST ADD '->defaults("group", "Settings")' IF YOU WANT TO GROUP A NAV IN A DROPDOWN

Route::get('/', function () {
    return view('welcome');
});

Route::get('/success', function () {
    return view('success');
});

Route::get('/success2', function () {
    return view('success2');
});

Route::get('/success3', function () {
    return view('success3');
});

Route::get('/error', function () {
    return view('error');
});

Route::get('/biometrics', function () {
    return view('biometrics');
});

Route::get("testUpload", "PatientController@testUpload")->name('testUpload');

Route::get("list", "PatientController@list")->name('list');
Route::get("getList", "PatientController@getList")->name('getList');
Route::get("getPayload", "PatientController@getPayload")->name('getPayload');
Route::get("checkNeedFP", "PatientController@checkNeedFP")->name('checkNeedFP');

Route::post("storeFp", "PatientController@storeFp")->name('storeFp');

// Route::get('/', function(){
//    return redirect()->route('login');
// });


Route::group([
        'middleware' => 'auth',
    ], function() {
        // Route::get('/', "DashboardController@index")->name('dashboard');


        // Route::get('/', 'DashboardController@index')
        //     ->defaults('sidebar', 1)
        //     ->defaults('icon', 'fas fa-list')
        //     ->defaults('name', 'Dashboard')
        //     ->defaults('roles', array('Admin'))
        //     ->name('dashboard')
        //     ->defaults('href', '/');

        // USER ROUTES
        $cname = "user";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("/", ucfirst($cname) . "Controller@index")
                    ->defaults("sidebar", 1)
                    ->defaults("icon", "fas fa-users")
                    ->defaults("name", ucfirst($cname) . "s")
                    ->defaults("roles", array("Super Admin", "Admin"))
                    // ->defaults("group", "Settings")
                    ->name($cname)
                    ->defaults("href", "/$cname");

                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("store/", ucfirst($cname) . "Controller@store")->name('store');
                Route::post("restore/", ucfirst($cname) . "Controller@restore")->name('restore');
                Route::post("delete/", ucfirst($cname) . "Controller@delete")->name('delete');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
                Route::post("updatePassword/", ucfirst($cname) . "Controller@updatePassword")->name('updatePassword');
            }
        );

        // THEME ROUTES
        $cname = "theme";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){
                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
            }
        );

        // DATATABLES
        $cname = "datatable";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("user", ucfirst($cname) . "Controller@user")->name('user');
            }
        );
    }
);

require __DIR__.'/auth.php';