<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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


/*
Route::get('products', [ProductController::class, 'index']);
// *insert a field in db using api
Route::post('products', [ProductController::class, 'store']);
*/

Route::resource('products', ProductController::class);
Route::get('products/search/{name}', [ProductController::class, 'search']);





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//--------------------------------------------------
//                  model
//--------------------------------------------------
// just like laravel app: 
    // php artisan make:model Product --migration
//--------------------------------------------------


//--------------------------------------------------------------
//                  *insert a field in db using api
//--------------------------------------------------------------
// do a routes like the above one,
//
// Also you have to do code in the controller, go and see it
// ..but you must specify that in the model as fillable field,
// ..which is a permission from laravel to allow you to fill a field in db
// 
// And most importantly, you have to put headers in the postman (the app that deal with apis):
//      key = Accept, value = application/json
// .. then you can send the body to add a new product, see it in postman
// .. you can add the body using raw json or x-www-form-urlencoded, i used the second one.
//
//
//---------------------------------------------------------------


//--------------------------------------------------
//                  api controllers
//--------------------------------------------------
// just like laravel app, but this one for api's,
// .. notice that --api is just like --resource which make all the CRUD functions
// .. but obviously this one is for api's:
    // php artisan make:controller ProductController --api
//--------------------------------------------------