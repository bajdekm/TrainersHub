<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'user' => 'API\UserController'
]);
Route::apiResources([
    'onlineuser' => 'API\UserOnlineController'
]);
Route::apiResources([
    'user-profile' => 'API\ProfileController'
]);
Route::apiResources([
    'role' => 'API\RoleController'
]);
Route::apiResources([
    'trainer' => 'API\TrainerController'
]);
Route::apiResources([
    'company' => 'API\CompanyController'
]);
Route::apiResources([
    'discipline' => 'API\DisciplineController'
]);
Route::apiResources([
    'opinion' => 'API\OpinionController'
]);
Route::apiResources([
    'gym' => 'API\GymController'
]);
Route::apiResources([
    'facility' => 'API\FacilityController'
]);
Route::apiResources([
    'reservation' => 'API\ReservationController'
]);
Route::get(
    'profile' , 'API\UserController@profile'
);
Route::get(
    'welcomeDisciplines' , 'API\WelcomeController@disciplines'
);
Route::get(
    'cities' , 'API\WelcomeController@cities'
);
Route::get(
    'searchTrainer' , 'API\WelcomeController@searchTrainer'
);
Route::get(
    'viewTrainer' , 'API\WelcomeController@viewTrainer'
);
Route::get(
    'roles' , 'API\UserController@roles'
);
Route::put('profile', 'API\UserController@updateProfile');
Route::post('user-profile-password', 'API\ProfileController@updatePassword');
Route::post('send-public-email', 'API\WelcomeController@sendPublicEmail');
Route::post('contact', 'API\WelcomeController@sendContactEmail');
Route::post('user-profile-check-password', 'API\ProfileController@checkPassword');
Route::get('user-profile', 'API\ProfileController@getUserDetail');
Route::get('server-info', 'API\SystemInfoController@sendServerInfo');
Route::get('findUser', 'API\UserController@search');
Route::get('findCompany', 'API\CompanyController@search');
Route::get('findDiscipline', 'API\DisciplineController@search');
Route::get('findGym', 'API\GymController@search');
Route::get('findFacility', 'API\FacilityController@search');
Route::get('findReservation', 'API\ReservationController@search');
Route::get('company/{id}', 'CompanyController@show');
Route::get('gym/{id}', 'GymController@show');
Route::get('trainer/{id}', 'TrainerController@show');
Route::get('user/{id}', 'UserController@show');
Route::get('reservation/{id}', 'ReservationController@show');
Route::get('findTrainer', 'API\TrainerController@search');
Route::get('detachFacility', 'API\GymController@detachFacility');
Route::get('detachDiscipline', 'API\TrainerController@detachDiscipline');
Route::get('detachRole', 'API\UserController@detachRole');
Route::get('attachFacility', 'API\GymController@attachFacility');
Route::get('attachDiscipline', 'API\TrainerController@attachDiscipline');
Route::get('attachRole', 'API\UserController@attachRole');
Route::get('showTrainerReservations', 'API\ReservationController@showTrainerReservations');
Route::get('retrieveTrainerByUserId', 'API\TrainerController@retrieveTrainerByUserId');
Route::get('retrieveDisciplinesByCategory', 'API\DisciplineController@retrieveDisciplinesByCategory');
Route::get('retrievePaintballOffer', 'API\WelcomeController@retrieveDisciplinesByCategory');
Route::get('retrievePaintballPricingDisciplines', 'API\DisciplineController@retrievePaintballPricingDisciplines');
Route::get('calculateOpinionsFields', 'API\TrainerController@calculateOpinionsFields');


