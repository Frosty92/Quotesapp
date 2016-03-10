<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    
    /******************homepage route ***************/
    Route::get('/{author?}', [
        'uses' => 'QuoteController@getIndex',
        'as'=>'index'
    ]);
    
    
       /******************user authentication routes ***************/
     Route::get('/admin/login', [
        'uses' => 'AdminController@getLogin',
        'as' => 'login'
    ]);
    
    Route::post('/admin/login', [
        'uses' => 'AdminController@postLogin',
        'as' => 'login'
    ]);
    
       
    Route::get('/admin/register', [
        'uses' => 'AdminController@getRegister',
        'as' => 'register'
    ]);
    
    Route::post('/admin/register', [
        'uses' => 'AdminController@postRegister',
        'as' => 'register'
    ]);
    
       
    Route::get('/admin/logout', [
        'uses' => 'AdminController@getLogout',
        'as' => 'logout'
    ]);
   
          
    Route::get('/auth/dashboard', [
        'uses' => 'AdminController@getDashboard',
        'as' => 'dashboard' 
    ]);
    
    
    /**************Creating and deleting quotes ****************/
    
    
      
    Route::post('quotes/new', [
        'uses' => 'QuoteController@postQuote',
        'as' => 'create'
    ]);
    
    Route::get('quotes/delete/{quote_id}', [
        'uses' => 'QuoteController@deleteQuote',
        'as' => 'delete'
    ]);
    
     /**************Playing the Quotes Game ****************/
      
    Route::get('/play/game/', [
        'uses' => 'GameController@getGame',
        'as' => 'game'
    ]);
    
     Route::get('/play/game/new', [
        'uses' => 'GameController@getNewGame',
        'as' => 'newgame'
    ]);
    
     Route::post('/play/game', [
        'uses' => 'GameController@postGame',
        'as' => 'game'
    ]);
    
});
