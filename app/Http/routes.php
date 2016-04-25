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

// Default Routes
Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Gleams API

Route::post('gleams-signup', array('uses' => 'ApiController@gleamsignUp', 'as' => 'api.gleamsignUp'));

Route::post('gleams_fb_signup', array('uses' => 'ApiController@fbsignUp', 'as' => 'api.fbsignUp'));

Route::post('login', array('uses' => 'ApiController@gleamsignIn', 'as' => 'api.gleamsignIn'));

Route::post('gleams_logout', array('uses' => 'ApiController@gleamslogOut', 'as' => 'api.gleamslogOut'));

Route::post('gleams_change_password', array('uses' => 'ApiController@changePassword', 'as' => 'api.changePassword'));

Route::post('gleams_follow', array('uses' => 'ApiController@gleamsFollow', 'as' => 'api.gleamsFollow'));

Route::post('gleams_unfollow', array('uses' => 'ApiController@gleamsunFollow', 'as' => 'api.gleamsunFollow'));

Route::post('gleams_message_send', array('uses' => 'ApiController@sendMessage', 'as' => 'api.sendMessage'));

Route::post('gleams_get_all_message', array('uses' => 'ApiController@getallMessage', 'as' => 'api.getallMessage'));

Route::post('follow_list', array('uses' => 'ApiController@followList', 'as' => 'api.followList'));

Route::post('gleams_message_status', array('uses' => 'ApiController@messageStatus', 'as' => 'api.messageStatus'));

Route::post('users_list', array('uses' => 'ApiController@usersList', 'as' => 'api.usersList'));

Route::post('following_list', array('uses' => 'ApiController@followingList', 'as' => 'api.followingList'));

Route::post('mutual_follow', array('uses' => 'ApiController@mutualFollow', 'as' => 'api.mutualFollow'));

Route::post('gleams_like', array('uses' => 'ApiController@gleamsLike', 'as' => 'api.gleamsLike'));

Route::post('gleams_unlike', array('uses' => 'ApiController@gleamsUnlike', 'as' => 'api.gleamsUnlike'));

Route::post('gleams_adv_like', array('uses' => 'ApiController@gleamsadvLike', 'as' => 'api.gleamsadvLike'));

Route::post('gleams_adv_unlike', array('uses' => 'ApiController@gleamsadvunLike', 'as' => 'api.gleamsadvunLike'));

//Route::post('api/gleams_gallery', array('uses' => 'ApiController@gleamsGallery', 'as' => 'api.gleamsGallery'));

Route::post('gleams_gallery_show', array('uses' => 'ApiController@gleamsGalleryshow', 'as' => 'api.gleamsGalleryshow'));

Route::post('message_per_person', array('uses' => 'ApiController@messageperPerson', 'as' => 'api.messageperPerson'));

Route::post('gleams_commenting', array('uses' => 'ApiController@gleamsCommenting', 'as' => 'api.gleamsCommenting'));

Route::post('gleams_adv_commenting', array('uses' => 'ApiController@gleamsadvCommenting', 'as' => 'api.gleamsadvCommenting'));

Route::post('api/gleams_insert_notify', array('uses' => 'ApiController@gleamsinsertNotify', 'as' => 'api.gleamsinsertNotify'));

Route::post('gleams_notification', array('uses' => 'ApiController@gleamsNotification', 'as' => 'api.gleamsNotification'));

Route::post('gleams_notification_status', array('uses' => 'ApiController@notificationStatus', 'as' => 'api.notificationStatus')); 

Route::post('notification_staus_change', array('uses' => 'ApiController@notificationstausChange', 'as' => 'api.notificationstausChange'));

Route::post('post_like_list', array('uses' => 'ApiController@postlikeList', 'as' => 'api.postlikeList'));

Route::post('adv_post_like_list', array('uses' => 'ApiController@advpostlikeList', 'as' => 'api.advpostlikeList'));

Route::post('commented_users', array('uses' => 'ApiController@commentedUsers', 'as' => 'api.commentedUsers')); 

Route::post('commented_adv_users', array('uses' => 'ApiController@commentedadvUsers', 'as' => 'api.commentedadvUsers'));

Route::post('message_count', array('uses' => 'ApiController@messageCount', 'as' => 'api.messageCount'));

Route::post('update_devicetoken', array('uses' => 'ApiController@updateDevicetoken', 'as' => 'api.updateDevicetoken')); 

Route::post('gleams_user_data', array('uses' => 'ApiController@gleamsuserData', 'as' => 'api.gleamsuserData'));

Route::post('request_vip', array('uses' => 'ApiController@requestVip', 'as' => 'api.requestVip'));

Route::post('forgot_password', array('uses' => 'ApiController@forgotPassword', 'as' => 'api.forgotPassword'));

Route::post('nearest_events', array('uses' => 'ApiController@nearestEvents', 'as' => 'api.nearestEvents'));

Route::post('gleams_gallery', array('uses' => 'ApiController@gleamsGallery', 'as' => 'api.gleamsGallery'));

Route::post('update_personal_info_gleams_user', array('uses' => 'ApiController@updatepersonalInfo', 'as' => 'api.updatepersonalInfo'));

Route::post('search', array('uses' => 'ApiController@searchApi', 'as' => 'api.searchApi'));

Route::post('news_feed', array('uses' => 'ApiController@newsFeed', 'as' => 'api.newsFeed'));

Route::post('profile_view', array('uses' => 'ApiController@profileView', 'as' => 'api.profileView'));

Route::post('comment_list', array('uses' => 'ApiController@commentList', 'as' => 'api.commentList'));

Route::post('adv_comment_list', array('uses' => 'ApiController@advcommentList', 'as' => 'api.advcommentList'));

Route::post('post', array('uses' => 'ApiController@gleamsPost', 'as' => 'api.gleamsPost'));
//Gleams API  Routes Ends Here
