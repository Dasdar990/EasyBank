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

Route::get('/', function () {
    return view('homepage');
});
Route::get('homepage', function () {
    return view('homepage');
});

Route::get('login', 'SignController@checkAuth');
Route::post('sign/login', 'SignController@checkLogin');
Route::post('sign/register', 'SignController@checkRegister');
Route::post('sign/register_2', 'SignController@checkRegister2');
Route::get('dashboard', 'DashController@checkAuth');
Route::get('logout', 'SignController@logout');
Route::post('error_request', 'ErrorController@returnError');
Route::post('requestTopbar', 'DashController@request_topbar');
Route::post('requestCC', 'DashController@request_cc');
Route::post('requestCCInfo', 'DashController@requestCCInfo');
Route::post('requestHistory', 'DashController@request_history');
Route::post('requestTransactions', 'DashController@request_transactions');
Route::post('requestFilters', 'DashController@requestFilters');
Route::post('requestAllTransactions', 'DashController@requestAllTransactions');
Route::post('requestAccountData', 'DashController@requestAccountData');
Route::post('requestLoanCC', 'DashController@requestLoanCC');
Route::post('requestLoanInfo', 'DashController@requestLoanInfo');
Route::post('requestSafeDepositInfo', 'DashController@requestSafeDepositInfo');
Route::post('RequestNewCardModal', 'DashController@RequestNewCardModal');
Route::post('AddNewCard', 'DashController@AddNewCard');
Route::post('setAsFavorite', 'DashController@setAsFavorite');
Route::post('RequestExchangeRates', 'DashController@RequestExchangeRates');
Route::post('RequestStock', 'DashController@RequestStock');
Route::post('requestLoading', 'DashController@requestLoading');





Route::get('test', 'TestController@test1');

