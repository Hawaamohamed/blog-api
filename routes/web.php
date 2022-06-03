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

Route::get('/','HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/notificationfcm', 'Controller@index');
Route::get('/send-notificationfcm', 'Controller@sendNotification')->name('send-notificationfcm');

//routes for profile
Route::get('/profile','profileController@index')->name('profile');
Route::put('/profile/update','profileController@update')->name('profile.update');

//routes for posts
Route::get('/posts','postController@index')->name('posts');
Route::get('/posts/trashed','postController@postsTrashed')->name('posts.trashed');
Route::get('/posts/create','postController@create')->name('posts.create');
Route::post('/post/store','postController@store')->name('post.store');
Route::get('/post/show/{slug}','postController@show')->name('post.show');
Route::get('/post/{id}','postController@edit')->name('post.edit');
Route::post('/post/update/{id}','postController@update')->name('post.update');
Route::get('/post/destroy/{id}','postController@destroy')->name('post.destroy'); //soft delete
Route::get('/post/hard_delete/{id}','postController@hard_delete')->name('post.hard_delete'); //hard delete
Route::get('/post/restore/{id}','postController@restore')->name('post.restore'); //restore

//routes for comments
Route::get('/comments','commentController@index')->name('comments');
Route::get('/comments/trashed','commentController@postsTrashed')->name('comments.trashed');
Route::get('/comments/create','commentController@create')->name('comments.create');
Route::post('/comment/store','commentController@store')->name('comments.store');
Route::get('/comment/show/{slug}','commentController@show')->name('comment.show');
Route::get('/comment/{id}','commentController@edit')->name('comment.edit');
Route::post('/comment/update/{id}','commentController@update')->name('comment.update');
Route::get('/comment/destroy/{id}','commentController@destroy')->name('comment.destroy'); //soft delete
Route::get('/comment/hard_delete/{id}','commentController@hard_delete')->name('comment.hard_delete'); //hard delete
 

//routes for category
Route::get('/category','categoryController@index')->name('category'); 
Route::get('/category/create','categoryController@create')->name('category.create');
Route::post('/category/store','categoryController@store')->name('category.store');
Route::get('/category/show/{slug}','categoryController@show')->name('category.show');
Route::get('/category/{id}','categoryController@edit')->name('category.edit');
Route::post('/category/update/{id}','categoryController@update')->name('category.update');
Route::get('/category/destroy/{id}','categoryController@destroy')->name('category.destroy');  
 

//routes for tags
 Route::get('/tags','TagController@index')->name('tags'); 
 Route::get('/tag/create','TagController@create')->name('tag.create');
 Route::post('/tag/store','TagController@store')->name('tag.store'); 
  Route::get('/tag/{id}','TagController@edit')->name('tag.edit');
  Route::post('/tag/update/{id}','TagController@update')->name('tag.update');

  Route::get('/tag/destroy/{id}','TagController@destroy')->name('tag.destroy');   



//routes for users
Route::get('/users','userController@index')->name('users'); 
Route::get('/user/create','userController@create')->name('user.create');
Route::post('/user/store','userController@store')->name('user.store'); 
Route::get('/user/destroy/{id}','userController@destroy')->name('user.destroy'); //soft delete  
Route::get('/user/posts/{id}','userController@user_posts')->name('user_posts'); 
Route::get('/user/active/{id}','userController@active')->name('user.active');   
Route::get('/user/disactive/{id}','userController@disactive')->name('user.disactive');   


 
//comments  
Route::get('post/comments/{id}','commentController@index')->name("post_comments");

  