<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('airgiftit');
});


// Route::get('/signin', function () {
//     return view('signin');
// });

// Route::get('/privacy-policy', function () {
//     return view('welcome');
// });

// Route::get('/login', 'UserController@login');

Route::get('/itemlookup', 'ItemController@itemLookup');

Route::post('/getDetails','TransactionController@getDetails');

Route::get('/authorizeAndCapture','TransactionController@authorizeAndCapture');