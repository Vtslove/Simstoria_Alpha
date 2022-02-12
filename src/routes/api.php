<?php

use Illuminate\Support\Facades\Route;

/**
 * Authintication for pusher private channels
 */
Route::post('/chat/auth', 'MessageController@pusherAuth')->name('api.pusher.auth');

/**
 *  Fetch info for specific id [user/group]
 */
Route::post('/idInfo', 'MessageController@idFetchData')->name('api.idInfo');

/**
 * Send message route
 */
Route::post('/sendMessage', 'MessageController@send')->name('api.send.message');

/**
 * Fetch messages
 */
Route::post('/fetchMessages', 'MessageController@fetch')->name('api.fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
Route::get('/download/{fileName}', 'MessageController@download')->name('api.'.config('chatify.attachments.download_route_name'));

/**
 * Make messages as seen
 */
Route::post('/makeSeen', 'MessageController@seen')->name('api.messages.seen');

/**
 * Get contacts
 */
Route::get('/getContacts', 'MessageController@getContacts')->name('api.contacts.get');

/**
 * Star in favorite list
 */
Route::post('/star', 'MessageController@favorite')->name('api.star');

/**
 * get favorites list
 */
Route::post('/favorites', 'MessageController@getFavorites')->name('api.favorites');

/**
 * Search in messenger
 */
Route::get('/search', 'MessageController@search')->name('api.search');

/**
 * Get shared photos
 */
Route::post('/shared', 'MessageController@sharedPhotos')->name('api.shared');

/**
 * Delete Conversation
 */
Route::post('/deleteConversation', 'MessageController@deleteConversation')->name('api.conversation.delete');

/**
 * Delete Conversation
 */
Route::post('/updateSettings', 'MessageController@updateSettings')->name('api.avatar.update');

/**
 * Set active status
 */
Route::post('/setActiveStatus', 'MessageController@setActiveStatus')->name('api.activeStatus.set');


