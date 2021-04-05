<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;


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
//you can use resource just like a regular controller: 
Route::resource('products', ProductController::class);
//.. but we won't use it here because we want to have a middleware for 
//.. the protected routes (like create and update and delete)
*/

//  ============== Public Routes ===============
Route::get('/products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);





//  ============== Protected Routes ==============

Route::group(['middleware' => ['auth:sanctum']], function(){
    // *insert a field in db using api
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'delete']);

    Route::post('/logout', [AuthController::class, 'logout']);

});






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
//
//--------------------------------------------------


//----------------------------------------------------------------
//                  Sanctum (api authentication)
//----------------------------------------------------------------
//This is laravel api authentication which called Sanctum, u install it using this: 
    // composer require laravel/sanctum
//
//Finish the installation following the documenation: 
//  https://laravel.com/docs/8.x/sanctum
//
//Also add this to the user model: 
// .. use Laravel\Sanctum\HasApiTokens;
//and inside the user class: 
// .. use HasApiTokens, HasFactory, Notifiable;
//
//------------------------------------------------------


//-----------------------------------------------------------------
//              Sanctum: public and protected routes 
//-----------------------------------------------------------------
// Public routes is a regular one just like the one u use it in LaravelApp
//
// Protected routes is also a regular routes but we use a middleware for it
// ..just like a checkpoint to make sure the request is authenticated,
// ..and for that we use Sanctum as a middleware
// ..or a middleware group (cuz we will use a group of routes).
//
//--------------------------------------------------------------------



//-------------------------------------------------------------------------------
//           Sanctum: register, login and logout (api authentication 2)
//-------------------------------------------------------------------------------
// AuthController:
    // php artisan make:controller AuthController
//.. yeah, very regular controller.. just to make the auth manually
//.. instead of using the laravel built-in auth which is not suitable for APIs
//
// How it works?
    // 1- You register typically like a regular laravel registration,
    // ..but this one in json file's body through a post request  (but using public routes).
    // 2- After you login or register (which auto login you),
    // ..it will give you a TOKEN!! this token is like a passkey or credentials
    // ..you will use it to access the protected methods (protected by auth Sanctum middleware)
    // 3- When you you logout, the system will destroy your Token.
//
//-------------------------------------------------------------------------------


//-------------------------------------------------------------------------------
//                          Postman Endpoints
//-------------------------------------------------------------------------------
// Postman is the App that deal and test the APIs.
//
// To see all the endpoints you made with this same project,
// ..sign in to Postman with your email, and see all
// ..the public and protected endpoints.
//
//
//-------------------------------------------------------------------------------
