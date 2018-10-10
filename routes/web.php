<?php

use App\GuestTransactionHistory;
use App\Setting;

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
Route::get('/records', function(){
$records = Setting::where('name', 'ROOM_TRANSFER_CHARGES')->first()->value;
dd($records);
});
Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();
Route::get('admin/users/lga', 'Admin\UsersController@lga');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {
Route::get('admin/{id}/updateuserorder', 'Admin\\MenuordersController@updateUserOrder');
Route::get('admin/checkout', 'Admin\\BookingsController@checkoutCreate');
Route::get('admin/{id}/invoice', 'Admin\\BookingsController@invoice');
Route::get('admin/{id}/checkout', 'Admin\\BookingsController@checkout');
Route::get('admin/bookroom', 'Admin\\BookingsController@booking');
Route::post('admin/bookroom', 'Admin\\BookingsController@storebooking');
Route::get('admin', 'Admin\AdminController@index');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
Route::resource('admin/menutypes', 'Admin\\MenutypesController');
Route::resource('admin/menus', 'Admin\\MenusController');
Route::resource('admin/roomtypes', 'Admin\\RoomtypesController');
Route::resource('admin/rooms', 'Admin\\RoomsController');
Route::resource('admin/facilities', 'Admin\\FacilitiesController');
Route::resource('admin/bookings', 'Admin\\BookingsController');
Route::resource('admin/menuorders', 'Admin\\MenuordersController');
Route::resource('admin/paymenttypes', 'Admin\\PaymenttypesController');
Route::resource('admin/services', 'Admin\\ServicesController');
Route::resource('admin/serviceorders', 'Admin\\ServiceordersController');
Route::resource('admin/states', 'Admin\\StatesController');
Route::resource('admin/lgas', 'Admin\\LgasController');
Route::resource('admin/navigationmenus', 'Admin\\NavigationmenusController');
});
