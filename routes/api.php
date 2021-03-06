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

Route::get('getFundDetails', 'Api\PassportController@getFundDetails');
Route::get('getEquityFunds', 'Api\PassportController@getEquityFunds');
Route::get('getDebtFunds', 'Api\PassportController@getDebtFunds');
Route::get('getHybridFunds', 'Api\PassportController@getHybridFunds');
Route::get('/FundHouseall', 'FundController@FundHouseall');
//Route::get('/getRelatedFunds', 'FundController@getRelatedFunds');
Route::get('getIciciFunds', 'Api\PassportController@getIciciFunds');

Route::get('getSbiFunds', 'Api\PassportController@getSbiFunds');
// Route::get('api/dropdown', function(){
//     $fund_house = Input::get('option');
//       $maker = Maker::find( $fund_house);
//       $models = $maker->models();
//       return Response::eloquent($models->get(['id','name']));
//   });
//Route::get('/FundHouse/{id}', 'FundController@FundHouse');
Route::post('login', 'Api\PassportController@login');
Route::post('register', 'Api\PassportController@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'Api\PassportController@details');
});
