<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Meetings;
use App\Users;
use App\UserNetwork;
use App\Deals;
use App\Invitations;
use App\Chat;
use App\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller {


    //Gleams Functions

    public function signUp() {
        $input = Input::all();
        return Users::signUp($input);
    }
    public function gleamsignUp() {
        $input = Input::all();
        return Users::gleamsignUp($input);
    }
    public function gleamsignIn() {
        $input = Input::all();
        return Users::gleamsignIn($input);
    }
    public function fbsignUp() {
        $input = Input::all();
        return Users::fbsignUp($input);
    }
    public function gleamslogOut() {
        $input = Input::all();
        return Users::gleamslogOut($input);
    }
    public function changePassword() {
        $input = Input::all();
        return Users::changePassword($input);
    }
    public function gleamsFollow() {
        $input = Input::all();
        return Users::gleamsFollow($input);
    }
    public function gleamsunFollow() {
        $input = Input::all();
        return Users::gleamsunFollow($input);
    }
    public function sendMessage() {
        $input = Input::all();
        return Users::sendMessage($input);
    }
    public function getallMessage() {
        $input = Input::all();
        return Users::getallMessage($input);
    }
    public function followList() {
        $input = Input::all();
        return Users::followList($input);
    }
    public function messageStatus() {
        $input = Input::all();
        return Users::messageStatus($input);
    }
    public function usersList() {
        $input = Input::all();
        return Users::usersList($input);
    }
    public function followingList() {
        $input = Input::all();
        return Users::followingList($input);
    }
    public function mutualFollow() {
        $input = Input::all();
        return Users::mutualFollow($input);
    }
    public function gleamsLike() {
        $input = Input::all();
        return Users::gleamsLike($input);
    }
    public function gleamsUnlike() {
        $input = Input::all();
        return Users::gleamsUnlike($input);
    }
    public function gleamsadvLike() {
        $input = Input::all();
        return Users::gleamsadvLike($input);
    }
    public function gleamsadvunLike() {
        $input = Input::all();
        return Users::gleamsadvunLike($input);
    }
    public function gleamsGalleryshow() {
        $input = Input::all();
        return Users::gleamsGalleryshow($input);
    }
    public function messageperPerson() {
        $input = Input::all();
        return Users::messageperPerson($input);
    }
    public function gleamsCommenting() {
        $input = Input::all();
        return Users::gleamsCommenting($input);
    }
    public function gleamsadvCommenting() {
        $input = Input::all();
        return Users::gleamsadvCommenting($input);
    }
    public function gleamsinsertNotify() {
        $input = Input::all();
        return Users::gleamsinsertNotify($input);
    }
    public function gleamsNotification() {
        $input = Input::all();
        return Users::gleamsNotification($input);
    }
    public function notificationStatus() {
        $input = Input::all();
        return Users::notificationStatus($input);
    }
    public function notificationstausChange() {
        $input = Input::all();
        return Users::notificationstausChange($input);
    }
    public function postlikeList() {
        $input = Input::all();
        return Users::postlikeList($input);
    }
    public function advpostlikeList() {
        $input = Input::all();
        return Users::advpostlikeList($input);
    }
    public function commentedUsers() {
        $input = Input::all();
        return Users::commentedUsers($input);
    }
    public function commentedadvUsers() {
        $input = Input::all();
        return Users::commentedadvUsers($input);
    }
    public function messageCount() {
        $input = Input::all();
        return Users::messageCount($input);
    }
    public function updateDevicetoken() {
        $input = Input::all();
        return Users::updateDevicetoken($input);
    }
    public function gleamsuserData() {
        $input = Input::all();
        return Users::gleamsuserData($input);
    }
    public function requestVip() {
        $input = Input::all();
        return Users::requestVip($input);
    }
    public function forgotPassword() {
        $input = Input::all();
        return Users::forgotPassword($input);
    }
    public function nearestEvents() {
        $input = Input::all();
        return Users::nearestEvents($input);
    }
    public function gleamsGallery() {
        $input = Input::all();
        return Users::gleamsGallery($input);
    }
    public function updatepersonalInfo() {
        $input = Input::all();
        return Users::updatepersonalInfo($input);
    }
    public function searchApi() {
        $input = Input::all();
        return Users::searchApi($input);
    }
    public function newsFeed() {
        $input = Input::all();
        return Users::newsFeed($input);
    }
    public function profileView() {
        $input = Input::all();
        return Users::profileView($input);
    }
    public function commentList() {
        $input = Input::all();
        return Users::commentList($input);
    }
    public function advcommentList() {
        $input = Input::all();
        return Users::advcommentList($input);
    }
    public function gleamsPost() {
        $input = Input::all();
        return Users::gleamsPost($input);
    }
    // User Functions

    public function login() {
        $input = Input::all();
        return Users::login($input);
    }

}
