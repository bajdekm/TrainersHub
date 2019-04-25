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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('welcome');
});
Route::get('/register-role', function () {
    return view('welcome');
})->where('path','([A-z\d-\/_.]+)?')->name('register-role');

Route::get('/search-trainer', function () {
    return view('welcome');
})->where('path','([A-z\d-\/_.]+)?')->name('search-trainer');

Route::get('/contact', function () {
    return view('welcome');
})->where('path','([A-z\d-\/_.]+)?')->name('contact');

Route::get('/trainer-panel/{path}', function () {
    return view('welcome');
})->where('path','([A-z\d-\/_.]+)?')->name('trainer');

Route::get('/trainer-panel', function () {
    return view('welcome');
})->where('path','([A-z\d-\/_.]+)?')->name('trainer');

Route::get('/user-panel', function () {
    return view('welcome');
})->where('path','([A-z\d\/_.]+)?')->name('user');

Route::get('/user-panel/{path}', function () {
    return view('welcome');
})->where('path','([A-z\d\/_.]+)?')->name('user');

Route::get('/search-trainer/{path}', function () {
    return view('welcome');
})->where('path','([A-z\d-\/_.]+)?')->name('search-trainer');

Route::get('/register-trainer', function () {
    return view('register-trainer');
});

Route::get('/invoice', function () {
    return view('invoice');
});

Route::get('/user-logout', function () {
    Auth::logout();
    return view('welcome');
});

Route::get('/user-remove/{id}', function ( $id ) {
    try {
        $condition = $id != null && Auth::user()->id == $id;

        if( $condition ){
            \Illuminate\Support\Facades\Auth::logout();
            \App\User::destroy($id);
            return view('welcome');
        }
    }
    catch (Exception $exc){
        return view('welcome');
    }

});

Auth::routes(['verify' => true]);

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{path}','HomeController@index')->where('path','([A-z\d\/_.]+)?');
