<?php
/**
 * -----------------------------------------------------------------
 * NOTE : There is two routes has a name (user & group),
 * any change in these two route's name may cause an issue
 * if not modified in all places that used in (e.g Chatify class,
 * Controllers, chatify javascript file...).
 * -----------------------------------------------------------------
 */

use Illuminate\Support\Facades\Route;

/*
* This is the main app route [Chatify Messenger]
*/
Route::get('/', 'MessageController@index')->name(config('chatify.routes.prefix'));

/**
 *  Fetch info for specific id [user/group]
 */
Route::post('/idInfo', 'MessageController@idFetchData');

/**
 * Send message route
 */
Route::post('/sendMessage', 'MessageController@send')->name('send.message');

/**
 * Fetch messages
 */
Route::post('/fetchMessages', 'MessageController@fetch')->name('fetch.messages');

/**
 * Download attachments route to create a downloadable links
 */
Route::get('/download/{fileName}', 'MessageController@download')->name(config('chatify.attachments.download_route_name'));

/**
 * Authintication for pusher private channels
 */
Route::post('/chat/auth', 'MessageController@pusherAuth')->name('pusher.auth');

/**
 * Make messages as seen
 */
Route::post('/makeSeen', 'MessageController@seen')->name('messages.seen');

/**
 * Get contacts
 */
Route::get('/getContacts', 'MessageController@getContacts')->name('contacts.get');

/**
 * Update contact item data
 */
Route::post('/updateContacts', 'MessageController@updateContactItem')->name('contacts.update');


/**
 * Star in favorite list
 */
Route::post('/star', 'MessageController@favorite')->name('star');

/**
 * get favorites list
 */
Route::post('/favorites', 'MessageController@getFavorites')->name('favorites');

/**
 * Search in messenger
 */
Route::get('/search', 'MessageController@search')->name('search');

/**
 * Get shared photos
 */
Route::post('/shared', 'MessageController@sharedPhotos')->name('shared');

/**
 * Delete Conversation
 */
Route::post('/deleteConversation', 'MessageController@deleteConversation')->name('conversation.delete');

/**
 * Delete Conversation
 */
Route::post('/updateSettings', 'MessageController@updateSettings')->name('avatar.update');

/**
 * Set active status
 */
Route::post('/setActiveStatus', 'MessageController@setActiveStatus')->name('activeStatus.set');






/*
* [Group] view by id
*/
Route::get('/group/{id}', 'MessageController@index')->name('group');

/*
* user view by id.
* Note : If you added routes after the [User] which is the below one,
* it will considered as user id.
*
* e.g. - The commented routes below :
*/
// Route::get('/route', function(){ return 'Munaf'; }); // works as a route
Route::get('/{id}', 'MessageController@index')->name('user');
// Route::get('/route', function(){ return 'Munaf'; }); // works as a user id
