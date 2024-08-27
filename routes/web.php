<?php

use App\Http\Controllers\SectionsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoiceArchiveController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Invoices
Route::resource('/invoices', InvoicesController::class);
//Sections
Route::resource('/sections', SectionsController::class);
//products
Route::resource('/products', ProductsController::class);

Route::resource('/Archive', InvoiceArchiveController::class);


Route::resource('/InvoiceAttachments','App\Http\Controllers\InvoiceAttachmentsController');







Route::get('/InvoicesDetails/{id}','App\Http\Controllers\InvoicesDetailsController@edit');

Route::get('download/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@get_file');

Route::get('View_file/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@open_file');

Route::post('delete_file', 'App\Http\Controllers\InvoicesDetailsController@destroy')->name('delete_file');




//Route::get('/InvoicesDetails/{id}','App\Http\Controllers\InvoicesDetailsController@index');

Route::get('/edit_invoice/{id}', 'App\Http\Controllers\InvoicesController@edit');

Route::get('/section/{id}', 'App\Http\Controllers\InvoicesController@getproducts');


Route::get('/Status_show/{id}', 'App\Http\Controllers\InvoicesController@show')->name('Status_show');
Route::post('/Status_Update/{id}','App\Http\Controllers\InvoicesController@Status_Update')->name('Status_Update');

Route::get('/Invoice_Paid','App\Http\Controllers\InvoicesController@Invoice_Paid');
Route::get('/Invoice_UnPaid','App\Http\Controllers\InvoicesController@Invoice_UnPaid');
Route::get('/Invoice_Partial','App\Http\Controllers\InvoicesController@Invoice_Partial');
Route::get('/Print_invoice/{id}','App\Http\Controllers\InvoicesController@Print_invoice');



Route::group(['middleware' => ['auth']],function() {

    Route::resource('users', 'App\Http\Controllers\UserController');

    Route::resource('roles', 'App\Http\Controllers\RoleController');
});


Route::get('/{page}', 'App\Http\Controllers\AdminController@index');



