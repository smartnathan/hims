<?php

use App\GuestTransactionHistory;
use App\Menuorder;
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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('loginPage');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
//Routes for Hotel Booking system

    Route::get('admin/users/lga', 'Admin\UsersController@lga');
Route::get('admin/rooms-status', 'Admin\\RoomsController@roomStatus');
Route::patch('admin/rooms-update-status/{id}', 'Admin\\RoomsController@updateRoomStatus');

Route::get('admin/room-reports', 'Admin\\ReportController@roomsBooking');
Route::get('admin/food-drink-reports', 'Admin\\ReportController@foodAndDrinksOrder');
Route::get('admin/general-reports', 'Admin\\ReportController@generalReport');

Route::get('admin/bookings/room-transfer', 'Admin\\BookingsController@room_transfer');
Route::get('admin/{id}/updateuserorder', 'Admin\\MenuordersController@updateUserOrder');
Route::get('admin/{id}/update-invoice', 'Admin\\BookingsController@updateInvoice');
Route::get('admin/{id}/generate-receipt', 'Admin\\BookingsController@receipt');
Route::get('admin/checkout', 'Admin\\BookingsController@checkoutCreate');
Route::get('admin/{id}/invoice', 'Admin\\BookingsController@invoice');
Route::get('admin/{id}/checkout', 'Admin\\BookingsController@checkout');

Route::patch('admin/room-transfer-update/{id}', 'Admin\\BookingsController@roomTransferUpdate');
Route::get('admin/bookroom', 'Admin\\BookingsController@booking');
Route::post('admin/bookroom', 'Admin\\BookingsController@storebooking');
Route::get('admin', 'Admin\AdminController@index');
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\UsersController');
Route::resource('admin/menutypes', 'Admin\\MenutypesController');
Route::resource('admin/menus', 'Admin\\MenusController');
Route::resource('admin/roomtypes', 'Admin\\RoomtypesController');
Route::resource('admin/rooms', 'Admin\\RoomsController');

Route::resource('admin/bookings', 'Admin\\BookingsController');
Route::resource('admin/menuorders', 'Admin\\MenuordersController');
Route::resource('admin/paymenttypes', 'Admin\\PaymenttypesController');
Route::resource('admin/services', 'Admin\\ServicesController');
Route::resource('admin/serviceorders', 'Admin\\ServiceordersController');
Route::resource('admin/states', 'Admin\\StatesController');
Route::resource('admin/lgas', 'Admin\\LgasController');
Route::resource('admin/navigationmenus', 'Admin\\NavigationmenusController');
Route::resource('admin/room-utilities', 'Admin\\RoomUtilitiesController');


//Newly added routes for Inventory system
Route::resource('admin/nationalities', 'Admin\\NationalitiesController');
Route::resource('admin/item-categories', 'Admin\\ItemCategoriesController');
Route::resource('admin/item-groups', 'Admin\\ItemGroupsController');
Route::resource('admin/item-brand-manufacturers', 'Admin\\ItemBrandManufacturersController');
Route::resource('admin/item-brands', 'Admin\\ItemBrandsController');
Route::resource('admin/item-stocks', 'Admin\\ItemStocksController');
Route::resource('admin/item-suppliers', 'Admin\\ItemSuppliersController');
Route::resource('admin/item-purchase-orders', 'Admin\\ItemPurchaseOrdersController');
Route::resource('admin/item-purchase-order-line', 'Admin\\ItemPurchaseOrderLineController');
Route::resource('admin/item-instances', 'Admin\\ItemInstancesController');
Route::resource('admin/items', 'Admin\\ItemsController');
Route::resource('admin/item-uoms', 'Admin\\ItemUomsController');
Route::resource('admin/item-images', 'Admin\\ItemImagesController');
});


