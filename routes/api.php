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
Route::post('/signup', 'AuthenticationController@signup');
Route::post('/log', 'AuthenticationController@login');
Route::post('/out', 'AuthenticationController@logout');


Route::middleware('apiaccess')->group(function () {

//for core user, only gives email, password, api_key, name and _id
Route::get('/user', 'UserController@index');

Route::get('/user/{id}', 'UserController@show');

Route::post('/user/{id}', 'UserController@update');

Route::DELETE('/user', 'UserController@delete');

//end User


//for user profile index, update and delete

Route::get('/profile', 'ProfileController@index');

// Route::post('/profile', 'ProfileController@store');

Route::get('/profile/{id}', 'ProfileController@show');

Route::post('/profile/{id}', 'ProfileController@update');

Route::DELETE('/profile', 'ProfileController@delete');

Route::post('/profile/{id}/attach', 'ProfileController@attach');

//end profile

//basic location Crud
Route::get('/location', 'LocationController@index');

Route::post('/location', 'LocationController@store');

Route::get('/location/{id}', 'LocationController@show');

Route::post('/location/{id}', 'LocationController@update');

Route::DELETE('/location', 'LocationController@delete');


//end location Crud


//interest categories crud
Route::get('/interestcategories', 'InterestCategoryController@index');

Route::post('/interestcategories', 'InterestCategoryController@store');

Route::get('/interestcategories/{id}', 'InterestCategoryController@show');

Route::post('/interestcategories/{id}', 'InterestCategoryController@update');

Route::DELETE('/interestcategories', 'InterestCategoryController@delete');

//end interest categories crud

//languages crud
Route::get('/languages', 'LanguagesController@index');

Route::post('/languages', 'LanguagesController@store');

Route::get('/languages/{id}', 'LanguagesController@show');

Route::post('/languages/{id}', 'LanguagesController@update');

Route::DELETE('/languages', 'LanguagesController@delete');

Route::post('/languages/{id}/attach', 'LanguagesController@attach');

//end languages crud

//interest crud
Route::get('/interest', 'InterestController@index');

Route::get('/interest/create', 'InterestController@create');

Route::post('/interest', 'InterestController@store');

Route::get('/interest/{id}', 'InterestController@show');

Route::post('/interest/{id}', 'InterestController@update');

Route::DELETE('/interest', 'InterestController@delete');

Route::post('/interest/{id}/attach', 'InterestController@attach');
//end interest crud

//Events crud
Route::get('/events', 'EventController@index');

Route::get('/events/create', 'EventController@create');

Route::post('/events', 'EventController@store');

Route::get('/events/{id}', 'EventController@show');

Route::post('/events/{id}', 'EventController@update');

Route::DELETE('/events', 'EventController@delete');

Route::post('/events/{id}/attach', 'EventController@attach');
//end Events crud


//posts crud

Route::get('/posts', 'PostController@index');

Route::get('/posts/create', 'PostController@create');

Route::post('/posts', 'PostController@store');

Route::get('/posts/{id}', 'PostController@show');

Route::post('/posts/{id}', 'PostController@update');

Route::DELETE('/posts', 'PostController@delete');

Route::post('/posts/{id}/attach', 'PostController@attach');

//end posts crud


Route::get('/posts/{post}/comments', 'CommentController@index');

Route::get('/posts/{post}/comment/create', 'CommentController@create');

Route::post('/posts/{post}/comment', 'CommentController@store');

Route::get('/posts/{post}/comment/{id}', 'CommentController@show');

Route::post('/posts/{post}/comment/{id}', 'CommentController@update');

Route::DELETE('/posts/{post}/comment/{id}', 'CommentController@delete');

Route::post('/posts/{id}/attach', 'CommentController@attach');


//post like and unlike

Route::post('/posts/like/{postId}', 'PostLikeController@like');

Route::post('/posts/unlike/{postId}', 'PostLikeController@unlike');

//end post like and unlike


//status crud

Route::get('/status', 'StatusController@index');

Route::get('/status/create', 'StatusController@create');

Route::post('/status', 'StatusController@store');

Route::get('/status/{id}', 'StatusController@show');

Route::post('/status/{id}', 'StatusController@update');

Route::DELETE('/status', 'StatusController@delete');

Route::post('/status/{id}/attach', 'StatusController@attach');

//end status crud

//all authenticated user routes
Route::get('/myevents', 'EventController@my_events');

Route::get('/myposts', 'PostController@my_posts');

Route::get('/mystatus', 'StatusController@my_status');

Route::get('/myconvos', 'MessageController@my_conversations');

Route::get('/mymessages', 'MessageController@my_messages');

//end all authenticated user routes





Route::get('/message', 'MessageController@index');

Route::post('/message/{sendTo}', 'MessageController@store');

Route::get('/message/{coversationId}', 'MessageController@show');



Route::post('/add_friend/{userRequestTo}', 'FriendshipController@add_friend');
Route::post('/accept_friend/{userRequestTo}', 'FriendshipController@accept_friend');
Route::get('/myfriends', 'FriendshipController@friends');
Route::get('/pendingrequests', 'FriendshipController@pending_requests');











});



    



