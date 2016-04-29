<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::get('/', ['middleware' => 'guest', 'uses' => 'UserController@getLogin', 'as' => 'auth.login',]);
Route::get('login', ['middleware' => 'guest', 'uses' => 'UserController@getLogin', 'as' => 'auth.login',]);
Route::post('login', ['middleware' => 'guest', 'uses' => 'UserController@postLogin',]);
Route::get('logout', function () {
    Auth::logout();

    return redirect('/');
});
Route::get('register', ['middleware' => 'guest', 'uses' => 'UserController@getRegister', 'as' => 'auth.register',]);
Route::post('register', ['middleware' => 'guest', 'uses' => 'UserController@postRegister',]);
Route::get('dashboard', ['middleware' => 'auth', 'uses' => 'UserController@getDashboard', 'as' => 'user.dashboard',]);
Route::get('profile', ['middleware' => 'auth', 'uses' => 'UserController@getProfile', 'as' => 'user.profile',]);
Route::get('activity', ['middleware' => 'auth', 'uses' => 'UserController@getUserActivity', 'as' => 'user.activity',]);

Route::post('postBoard', ['middleware' => 'auth', 'uses' => 'BoardController@postBoard',]);

/**
 * Board
 */
Route::group(
    ['prefix' => 'board', 'namespace' => 'App\Http\Controllers'],
    function () {
        Route::post('/postListName', ['uses' => 'ListController@postListName',]);
        Route::post('/delete-list', ['uses' => 'ListController@deleteList',]);
        Route::post('/update-list-name', ['uses' => 'ListController@updateListName',]);

        Route::post('/postCard', ['uses' => 'CardController@postCard',]);
        Route::post('/changeCardList', ['uses' => 'CardController@changeCardList',]);
        Route::post('/deleteCard', ['uses' => 'CardController@deleteCard',]);
        Route::post('/getCardDetail', ['uses' => 'CardController@getCardDetail',]);
        Route::post('/update-card-data', ['uses' => 'CardController@updateCardData',]);

        Route::post('/save-comment', ['uses' => 'CommentController@saveComment',]);

        Route::post('/save-task', ['uses' => 'TaskController@saveTask',]);
        Route::post('/delete-task', ['uses' => 'TaskController@deleteTask',]);
        Route::post('/update-task-completed', ['uses' => 'TaskController@updateTaskCompleted',]);

        Route::get('/{id?}', ['middleware' => 'auth', 'uses' => 'BoardController@getBoardDetail', 'as' => 'user.boardDetail',]);
    }
);