<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Davibennun\LaravelPushNotification\Facades\PushNotification;

// require 'vendor/autoload.php';
// use Mailgun\Mailgun;

class Users extends Model {

    protected $table = 'socialite_user';
    //Gleams validation Rules
    
    public static $changepasswordRules = array(
        'old_pass' => 'required',
        'auth_key' => 'required|exists:socialite_user,auth_key',
        'new_pass' => 'required'
    );
    public static $gleamsfollowRules = array(
        'follow' => 'required',
        'id' => 'required|exists:socialite_user,id'
    );
    public static $gleamsunfollowRules = array(
        'unfollow' => 'required',
        'id' => 'required|exists:socialite_user,id'
    );
    public static $sendmessageRules = array(
        'user_id' => 'required|exists:socialite_user,id',
        'receiver_id' => 'required|exists:socialite_user,id',
        'message' => 'required'
    );
    public static $getallmessageRules = array(
        'user_id' => 'required|exists:socialite_user,id'
    );
    public static $messagestatusRules = array(
        'user_id' => 'required|exists:socialite_user,id',
        'receiver_id' => 'required|exists:socialite_user,id'
    );
    public static $userslistRules = array(
        'search_text' => 'required'
    );
     public static $gleamsLikeRules = array(
        'user_id' => 'required|exists:socialite_user,id',
        'post_id' => 'required'
    );
     public static $galleryshowRules = array(
        'user_ID' => 'required|exists:socialite_user,id'
    );
     public static $messageperPersonRules = array(
        'user_id' => 'required|exists:socialite_user,id',
        'individual_id' => 'required|exists:socialite_user,id'
    );
    public static $gleamsCommentingRules = array(
        'user_id' => 'required|exists:socialite_user,id',
        'message_id' => 'required',
        'comment' => 'required'
    );
    public static $gleamsinsertNotifyRules = array(
        'user_id' => 'required|exists:socialite_user,id',
        'message' => 'required',
        'notifier_type' => 'required',
        'notify_id' => 'required'
    );
    public static $gleamsNotificationRules = array(
        'notify_id' => 'required'
    );
    public static $nsChangeRules = array(
        'user_id' => 'required'
    );
    public static $postlikeListRules = array(
        'user_id' => 'required'
    );
    public static $udvRules = array(
        'user_id' => 'required|exists:socialite_user,id',
        'device_token' => 'required'
    );
    public static $gleamsuserDataRules = array(
        'user_id' => 'required|exists:socialite_user,id',
        'user_type' => 'required'
    );
    public static $requestVipRules = array(
        'id' => 'required|exists:socialite_user,id',
        'name' => 'required',
        'email' => 'required|email',
        'budget' => 'required',
        'people' => 'required',
        'pnumber' => 'required'
    );
    public static $forgotPasswordRules = array(
        'email' => 'required|exists:socialite_user,user_email'
    );
    public static $nearestEventsRules = array(
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'distance' => 'required|numeric',
        'user_id' => 'required|exists:socialite_user,id'
    );
    public static $gleamsGalleryRules = array(
        'gallery' => 'required',
        'user_id' => 'required|exists:socialite_user,id'
    );
    public static $updatepersonalInfo = array(
        'auth_key' => 'required|exists:socialite_user,auth_key',
        'first_name' => 'required'
    );
    public static $searchapiRule = array(
        'user_id' => 'required|exists:socialite_user,id',
        'search_type' => 'required'
    );
    public static $newsFeedRules = array(
        'auth_key' => 'required|exists:socialite_user,auth_key',
        'user_id' => 'required|exists:socialite_user,id'
    );
    public static $commentlistRule = array(
        'post_id' => 'required|exists:gleams_post,post_id',
        'user_id' => 'required|exists:socialite_user,id'
    );
     public static $advcommentlistRule = array(
        'post_id' => 'required|exists:gleams_adv,adv_id',
        'user_id' => 'required|exists:socialite_user,id'
    );
     public static $gleamsPostRule = array(
        'message' => 'required',
        'user_id' => 'required|exists:socialite_user,id'
    );

    public static $gleamlogoutRules = array(
        'user_id' => 'required'
    );
    public static $gleamsusernameRule = array(
        'user_name' => 'Unique:socialite_user'
    );
    public static $gleamsignUpRules = array(
        'user_name' => 'required|Unique:socialite_user',
        'user_email' => 'required|email|Unique:socialite_user', 
        'user_type' => 'required',       
        'password' => 'required',
        'first_name' => 'required'
    );
    public static $gleamfbsignUpRules = array(
        'user_name' => 'required',
        'facebookid' => 'required', 
        'user_type' => 'required'
    );
    public static $gleamsigninRules = array(
        'user_name' => 'required',       
        'password' => 'required'
    );
    public static $loginRules = array(
        'id' => 'required',
        'password' => 'required',
    );

    public static $forgotPassword3Rules = array(
        'password' => 'required',
        'confirm_password' => 'required',
        'user_id' => 'required',
    );

    // Validation Rules

    // Common Funtions

    //Generate Token for Auth key
    public static function generateToken() {
        return $access_token = str_random(30);
    }

    //Gleams normal sign up sarts here 
     public static function gleamsignUp($input) {

        $validation = Validator::make($input, Users::$gleamsignUpRules);
        if($validation->fails()) {
            return Response::json(array('status'=>0, 'msg'=>$validation->getMessageBag()->first()), 200);
        }
        else {
            $name = $input['user_name'];
            $email = $input['user_email'];
            $password = $input['password'];
            $firstname = $input['first_name']; 
            $usertype = $input['user_type'];            
            $password = hash::make($password);
            $current_time = Carbon::now();
            $access_token = Users::generateToken();
            $sagar=  array(
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'name' => $name,
                    'access_token' => $access_token,
                    'created_at' => $current_time,
                    'updated_at' => $current_time,
                );
            
            $user_id = DB::table('socialite_user')->insertGetId(
                array(
                    'user_name' => $name,
                    'user_email' => $email,
                    'password' => $password,
                    'auth_key' => $access_token,
                    'user_type' => $usertype
                )
            );
            DB::table('enthusiastic_user')->insertGetId(
                array(
                    'id' => $user_id,
                    'first_name' => $firstname,
                    'last_name' => ' '
                )
            );
            return Response::json(array('status'=>1, 'msg'=>$user_id, 'user_details'=> $sagar), 200);

        }

    }

//Gleams  normal sign up ends Here //
//Gleams signin starts here 
    public static function gleamsignIn($input) {

        $validation = Validator::make($input, Users::$gleamsigninRules);
        if($validation->fails()) {
            return Response::json(array('status'=>0, 'msg'=>$validation->getMessageBag()->first()), 200);
        }
        else {
            $name = $input['user_name'];
            $password = $input['password'];            
            //$password = hash::make($password);

            $userCount = DB::table('socialite_user')->where('user_name','=', $name)->count();
            if($userCount>0){
                $userDetails = DB::table('socialite_user')->where('user_name','=', $name)->first();
                if (hash::check($password, $userDetails->password)) {
                    $tableDetails = DB::table($userDetails->user_type.'_user')->where('id','=', $userDetails->id)->first();
                    if($userDetails->user_type=="event"){
                        return Response::json(array('status' => "Success", "msg" => "User exist",'id' => $userDetails->id,'user_type' => $userDetails->user_type, 'user_name' => $userDetails->user_name,'email' => $userDetails->user_email,'password' => $userDetails->password,'event_name' => $tableDetails->event_name,'auth_key' => $userDetails->auth_key), 200);
                    } elseif($userDetails->user_type=="venue") {
                        return Response::json(array('status' => "Success", "msg" => "User exist",'id' => $userDetails->id,'user_type' => $userDetails->user_type, 'user_name' => $userDetails->user_name,'email' => $userDetails->user_email,'password' => $userDetails->password,'venue_name' => $tableDetails->venue_name,'auth_key' => $userDetails->auth_key), 200);
                    } else {
                        return Response::json(array('status' => "Success", "msg" => "User exist",'id' => '$userDetails->id','user_type' => $userDetails->user_type, 'user_name' => $userDetails->user_name,'email' => $userDetails->user_email,'password' => $userDetails->password,'first_name' => $tableDetails->first_name,'last_name' => $tableDetails->last_name,'about' => $tableDetails->about,'cover_pic' => $userDetails->cover_pic,'profile_pic' => $userDetails->profile_pic,'auth_key' => $userDetails->auth_key), 200);
                    }                    
                } else{
                     return Response::json(array('status' => "Failed", "msg" => "Invalid User Name or Password"), 200);
                }
            } else {
                return Response::json(array('status' => "Failed", "msg" => "Invalid User Name or Password"), 200);
            }            
        }
    }

//Gleams  signin ends Here //
    //Gleams FB sign up sarts here 
     public static function fbsignUp($input) {
        $validation = Validator::make($input, Users::$gleamfbsignUpRules);
        if($validation->fails()) {
            return Response::json(array('status'=>0, 'msg'=>$validation->getMessageBag()->first()), 200);
        }
        else {
            $name = $input['user_name'];
            $email = $input['facebookid'];
            $fbCount = DB::table('socialite_user')->where('user_email', $email)->count();
            if($fbCount>0){
                $userDetails = DB::table('socialite_user')->where('user_email', $email)->first();
                return Response::json(array('status' => "Success", "msg" => "Already Exist.",'id' => $userDetails->id,'user_name' => $userDetails->user_name,'password' => '12345','auth_key' => $userDetails->auth_key,'user_type' => $userDetails->user_type), 200);                
            } else{
                $validation = Validator::make($input, Users::$gleamsusernameRule);
                if($validation->fails()) {
                    return Response::json(array('status'=>0, 'msg'=>$validation->getMessageBag()->first()), 200);
                }
                $password = '12345';
                $firstname = $input['first_name']; 
                $usertype = $input['user_type'];            
                $password = hash::make($password);
                $current_time = Carbon::now();
                $access_token = Users::generateToken();
                $user_id = DB::table('socialite_user')->insertGetId(
                    array(
                        'user_name' => $name,
                        'user_email' => $email,
                        'password' => $password,
                        'auth_key' => $access_token,
                        'user_type' => $usertype
                    )
                );
                DB::table('enthusiastic_user')->insertGetId(
                    array(
                        'id' => $user_id,
                        'first_name' => $firstname,
                        'last_name' => ' '
                    )
                );
                return Response::json(array('status' => "Success", "msg" => "New Record.",'id' => $user_id,'user_name' => $name,'password' => $password,'auth_key' => $access_token,'user_type' => "enthusiastic"), 200);
            }            
            

        }

    }

    //Gleams  FB sign up ends Here 

    //Gleams  Log Out stats here 

    public static function gleamslogOut($input) {
        $validation = Validator::make($input, Users::$gleamlogoutRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        }
        else {
            $userId = $input['user_id'];
            DB::table('socialite_user')->where('id', $userId)->update(['device_token' => ' ']);
            return Response::json(array('status' => "Success"), 200);
        }
    }

    //Gleams  Log Out ends here 

    public static function PushNotification($UserID,$AuthKey,$UserName,$Type,$PostID,$DeviceToken,$ProfilePic) {
        // Put your device token here (without spaces):
        $deviceToken = str_replace(' ','',$DeviceToken);
        // Put your private key's passphrase here:
        $passphrase = 'gleam';
        // Put your alert message here:
        //badge
        if($Type=='follow' OR $Type=='unfollow'){ $message = $UserName.' Started '.$Type.'ing You'; }
        elseif($Type=="message"){ $message = $UserName.' sent a message to you'; } 
        elseif($Type=="like"){ $message = $UserName.' liked your post'; }
        elseif($Type=="commenting"){$message = $UserName.' commented on your post'; }
        elseif($Type=="tagging"){ $message = $UserName.' was tagged you on a post!'; }
        elseif($Type=="unlike") { $message = $UserName.' unliked your post'; }
        else {$message ='No type send by IOS native side';}
        $badge = 1;
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', app_path().'/pushCertificate/Gleam_pro.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        // Open a connection to the APNS server
        $fp = stream_socket_client(
        //    'ssl://gateway.sandbox.push.apple.com:2195', $err,
            'ssl://gateway.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            //exit("connection error: $err $errstr");
        
            $message =ucfirst($message);
            $body['aps'] = array(
                                    'alert' => $message,
                                    'badge' => 1,
                                    'sound' => 'default',
                                    'username' => $UserName,
                                    'auth_key' => $AuthKey,
                                    'user_id' => $UserID,
                                    'post_id' => $PostID,
                                    'type' => $Type,
                                    'profile_pic'=>$ProfilePic);
        
        // Encode the payload as JSON
        $payload = json_encode($body);
        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        // Close the connection to the server
        fclose($fp);
    }

    //Gleams  Change Password stats here

    public static function changePassword($input) {
        $validation = Validator::make($input, Users::$changepasswordRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        }
        else {
            $authKey = $input['auth_key'];
            $oldPassword = $input['old_pass'];
            $newPassword = hash::make($input['new_pass']);
            $userConfirm = DB::table('socialite_user')->where('auth_key', $authKey)->count();
            if($userConfirm>0){
                $userDetails = DB::table('socialite_user')->where('auth_key', $authKey)->first();
                if (hash::check($oldPassword, $userDetails->password)) {
                    DB::table('socialite_user')->where('id', $userDetails->id)->update(['password' => $newPassword]);
                    return Response::json(array('msg' => "Suceess"), 200);

                   
                } else {
                    return Response::json(array('msg' => "old password miss match"), 200);
                }
                
            } else {
                    return Response::json(array('msg' => "No record found"), 200);
            }
            
        }
    }
    //Gleams  Change Password ends here

    //Gleams  follow starts here
    public static function gleamsFollow($input) {
        $validation = Validator::make($input, Users::$gleamsfollowRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        }
        else {
            $userId = $input['id'];
            $followId = $input['follow'];
            $followlistCount = DB::table('follow_table')->select('follow')->where('id', $userId)->count();
            $deviceToken = DB::table('socialite_user')->select('device_token','auth_key')->where('id', $followId)->first();
            $pushnotificationData = DB::table('socialite_user')->select('auth_key','user_name','profile_pic')->where('id', $userId)->first();
            if($followlistCount>0){
                $followList = DB::table('follow_table')->select('follow')->where('id', $userId)->first();
                $followlistArray = explode(',' , $followList->follow);
                if (in_array($followId, $followlistArray)) {
                    return Response::json(array('msg' => "You are alredy following"), 200);
                }else{
                    $updatedfollowValue=$followList->follow.",".$followId;
                    DB::table('follow_table')->where('id', $userId)->update(['follow' => $updatedfollowValue]);
                    DB::table('gleams_notification')->insertGetId(
                        array(
                            'sender' => $userId,
                            'receiver' => $followId,
                            'notifier_type' => 'follow',
                            'message' => '',
                            'status' => '0'
                        )
                    );
                    $profileimageUrl = strpos($pushnotificationData->profile_pic, 'https://');
                    if ($profileimageUrl !== false) {
                        $profileUrl=$pushnotificationData->profile_pic; 
                    } else {
                        $profileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$pushnotificationData->profile_pic;
                    }
                    //PushNotification($UserID,$AuthKey,$UserName,$Type,$PostID,$DeviceToken,$ProfilePic)
                    if($deviceToken->device_token!=' '){
                        Users::PushNotification($userId,$pushnotificationData->auth_key,$pushnotificationData->user_name,'follow','0',$deviceToken->device_token,$profileUrl);                    
                    }
                    return Response::json(array('msg' => 'Success'), 200);
                }                                                            
            } else {
                    DB::table('follow_table')->insertGetId(
                        array(
                            'id' => $userId,
                            'follow' => $followId
                        )
                    );
                    DB::table('gleams_notification')->insertGetId(
                        array(
                            'sender' => $userId,
                            'receiver' => $followId,
                            'notifier_type' => 'follow',
                            'message' => '',
                            'status' => '0'
                        )
                    );
                    $profileimageUrl = strpos($pushnotificationData->profile_pic, 'https://');
                    if ($profileimageUrl !== false) {
                        $profileUrl=$pushnotificationData->profile_pic; 
                    } else {
                        $profileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$pushnotificationData->profile_pic;
                    }
                    if($deviceToken->device_token!=' '){
                        Users::PushNotification($userId,$pushnotificationData->auth_key,$pushnotificationData->user_name,'follow','0',$deviceToken->device_token,$profileUrl);                    
                    }
                    return Response::json(array('msg' => "Success"), 200);
            }
            
        }
    }
    //Gleams  follow end heregleamsunFollow

    //Gleams  unfollow starts here
    public static function gleamsunFollow($input) {
        $validation = Validator::make($input, Users::$gleamsunfollowRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        }
        else {
            $userId = $input['id'];
            $followId = $input['unfollow'];
            $followlistCount = DB::table('follow_table')->select('follow')->where('id', $userId)->count();
            $deviceToken = DB::table('socialite_user')->select('device_token','auth_key')->where('id', $followId)->first();
            $pushnotificationData = DB::table('socialite_user')->select('auth_key','user_name','profile_pic')->where('id', $userId)->first();
            if($followlistCount>0){
                $followList = DB::table('follow_table')->select('follow')->where('id', $userId)->first();
                $followlistArray = explode(',' , $followList->follow);
                if(count($followlistArray)==1){
                    DB::table('follow_table')->where('id', $userId)->delete();
                    DB::table('gleams_notification')->insertGetId(
                            array(
                                'sender' => $userId,
                                'receiver' => $followId,
                                'notifier_type' => 'unfollow',
                                'message' => '',
                                'status' => '0'
                            )
                        );
                    $profileimageUrl = strpos($pushnotificationData->profile_pic, 'https://');
                    if ($profileimageUrl !== false) {
                        $profileUrl=$pushnotificationData->profile_pic; 
                    } else {
                        $profileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$pushnotificationData->profile_pic;
                    }
                    if($deviceToken->device_token!=' '){
                        Users::PushNotification($userId,$pushnotificationData->auth_key,$pushnotificationData->user_name,'unfollow','0',$deviceToken->device_token,$profileUrl);                    
                    }
                    return Response::json(array('msg' => "Success"), 200);
                } else {
                    if (in_array($followId, $followlistArray)) {
                        unset($followlistArray[array_search($followId, $followlistArray)]);
                        $updatedfollowValue = implode(",", $followlistArray);
                        DB::table('follow_table')->where('id', $userId)->update(['follow' => $updatedfollowValue]);
                        DB::table('gleams_notification')->insertGetId(
                            array(
                                'sender' => $userId,
                                'receiver' => $followId,
                                'notifier_type' => 'unfollow',
                                'message' => '',
                                'status' => '0'
                            )
                        );
                        $profileimageUrl = strpos($pushnotificationData->profile_pic, 'https://');
                        if ($profileimageUrl !== false) {
                            $profileUrl=$pushnotificationData->profile_pic; 
                        } else {
                            $profileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$pushnotificationData->profile_pic;
                        }
                        if($deviceToken->device_token!=' '){
                            Users::PushNotification($userId,$pushnotificationData->auth_key,$pushnotificationData->user_name,'unfollow','0',$deviceToken->device_token,$profileUrl);
                        }
                        return Response::json(array('msg' => "Success"), 200);
                    } else {
                        return Response::json($success = array('msg' => "Something went wrong"), 200);
                    }
                }                                                            
            } else {
                    return Response::json($success = array('msg' => "Something went wrong"), 200);
            }
            
        }
    }
    //Gleams  unfollow end here

    //Gleams  Send Message stats here

    public static function sendMessage($input) {
        $validation = Validator::make($input, Users::$sendmessageRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        }
        else {
            $userId = $input['user_id'];
            $receiverId = $input['receiver_id'];
            $message = $input['message'];
            date_default_timezone_set("UTC");
            $date = date('Y-m-d H:i:s');
            $messageQuery = DB::table('gleams_message')->insertGetId(
                            array(
                                'user_id' => $userId,
                                'receiver_id' => $receiverId,
                                'message' => $message
                            )
                        );
            if($messageQuery){
                //Do Push notification coding                
                $SenderDetails = DB::table('socialite_user')->where('id', $userId)->first();                
                $ReceiverDetails = DB::table('socialite_user')->where('id', $receiverId)->first();
                $ProfileImageUrl = strpos($SenderDetails->profile_pic, 'https://');
                if ($ProfileImageUrl !== false) {
                    $ProfileUrl=$SenderDetails->profile_pic; 
                } else {
                    $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$SenderDetails->profile_pic;
                }
                if($ReceiverDetails->device_token!=' '){                           
                    Users::PushNotification($userId,$SenderDetails->auth_key,$SenderDetails->user_name,'message','0',$ReceiverDetails->device_token,$ProfileUrl);                    
                }
                return Response::json(array('msg' => "success"), 200);
            } else {
                    return Response::json(array('status' => "Failed", "msg" => "Sorry something went wrong"), 200);
            }
                
        } 
            
    }
    //Gleams  Send Message ends here

    //Gleams  Get all Message starts here
    public static function getallMessage($input) {
        $validation = Validator::make($input, Users::$getallmessageRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $messageList = DB::table('gleams_message')->select('receiver_id','user_id')->where('user_id', $userId)->orwhere('receiver_id', $userId)->orderBy('time_stamp' , 'DESC')->get();
            foreach ($messageList as $newessageArray){
                $reciverArray[] = $newessageArray->receiver_id;            
                $senderArray[] = $newessageArray->user_id;
            }
            $finalmessagelistId=array_unique(array_merge($reciverArray,$senderArray));
            $ListofmessageId=array_diff($finalmessagelistId, array($userId));
            foreach ($ListofmessageId as &$value) {
                $unreadCount = DB::table('gleams_message')->where('user_id', $value)->where('receiver_id', $userId)->where('status' , '0')->count();
                $messageBody = DB::select("SELECT * FROM  `gleams_message` WHERE  ((`user_id`=".$value." AND  `receiver_id`=".$userId.") OR (`user_id`=".$userId." AND  `receiver_id`=".$value.")) ORDER BY msg_id DESC LIMIT 0,1");
                $userBody = DB::table('socialite_user')->where('id', $value)->first();
                $profileimageUrl = strpos($userBody->profile_pic, 'https://');
                if ($profileimageUrl !== false) {
                    $ProfileUrl=$userBody->profile_pic; 
                } else {
                    $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$userBody->profile_pic;
                }
                $messageArray[] = array('message_id'=>$messageBody[0]->msg_id,'sender_id' => $value,'user_name' => $userBody->user_name,'profile_pic' => $ProfileUrl,'message' => $messageBody[0]->message,'unread_count'=>$unreadCount,'time_stamp' => $messageBody[0]->time_stamp);
            }
            date_default_timezone_set("UTC");
            $messageArray = array_reverse($messageArray);
            return Response::json(array('status' => "success",'server_time'=>date('Y-m-d H:i:s'),'msg'=> $messageArray), 200);
        } 
                
    }
    //Gleams   Get all Message here

    //Gleams  messageStatus starts here
    public static function messageStatus($input) {
        $validation = Validator::make($input, Users::$messagestatusRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $receiverId = $input['receiver_id'];
            $messageCount = DB::table('gleams_message')->select('msg_id')->where('user_id', $userId)->where('receiver_id', $receiverId)->where('status', '0')->count();
            if($messageCount>0){
                $messageList = DB::table('gleams_message')->select('msg_id')->where('user_id', $userId)->where('receiver_id', $receiverId)->where('status','0')->get();
                foreach ($messageList as $value){
                    DB::table('gleams_message')->where('msg_id', $value->msg_id)->update(['status' => '1']);
                }
                return Response::json(array('status' => "success"), 200);
            } else {
                return Response::json(array('status' => "error"), 200);
            }
        } 
                
    }
    //Gleams   messageStatus ends here usersList

    //Gleams  usersList starts here
    public static function usersList($input) {
        $validation = Validator::make($input, Users::$userslistRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userInput = $input['search_text'];
            $userDetailscount = DB::table('socialite_user')->where('user_name', 'like', $userInput.'%')->count();
            if($userDetailscount>0){
                $userDetail = DB::table('socialite_user')->where('user_name', 'like', $userInput.'%')->get();
                foreach ($userDetail as $value){
                    $userindData = DB::table($value->user_type.'_user')->where('id', $value->id)->first();
                    if($value->user_type=="enthusiastic" OR $value->user_type=="host" OR $value->user_type=="artist")
                    { $name=$userindData->first_name; }
                    else{
                        $er=$value->user_type."_name";
                        $name=$userindData->$er;
                    }
                    $ProfileImageUrl = strpos($value->profile_pic, 'https://');
                    if ($ProfileImageUrl !== false) {
                        $ProfileUrl=$value->profile_pic; 
                    } else {
                        $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$value->profile_pic;
                    }
                    $finalResult[] = array('user_id' =>$value->id,'user_email' =>$value->user_email,'user_name' =>$value->user_name,'user_type' =>$value->user_type,'name' =>$name,'auth_key' =>$value->auth_key,'profile_pic' =>$ProfileUrl);
                }
            } else {
                $finalResult = array();                    
            }  
            return Response::json(array('status' => "success",'follow_list'=> $finalResult), 200); 
        }          
    }
    //Gleams   usersList ends here 

    //Gleams  Follow List starts here
    public static function followList($input) {
        $validation = Validator::make($input, Users::$getallmessageRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        }else {
            $userId = $input['user_id'];
            $followListcount = DB::table('follow_table')->where('id', $userId)->count();
            if($followListcount>0){
                $followList = DB::table('follow_table')->where('id', $userId)->first();
                $FollowlistArray = explode(',',$followList->follow);
                foreach ($FollowlistArray as &$value) { 
                    $userDetails = DB::table('socialite_user')->select('id','user_email','user_name','auth_key','profile_pic','user_type')->where('id', $value)->first();
                    $indTable = DB::table($userDetails->user_type.'_user')->where('id', $value)->first();
                    if($userDetails->user_type=="enthusiastic" OR $userDetails->user_type=="host" OR $userDetails->user_type=="artist")
                    { $name=$indTable->first_name; }
                    else{
                        $er=$userDetails->user_type."_name";
                        $name=$indTable->$er;
                    }
                    $ProfileImageUrl = strpos($userDetails->profile_pic, 'https://');
                    if ($ProfileImageUrl !== false) {
                        $ProfileUrl=$$userDetails->profile_pic; 
                    } else {
                        $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$userDetails->profile_pic;
                    }
                    if($userDetails->user_type=="artist"){
                        $SoundCloud=$indTable->soundcloud_url;
                    }else{
                        $SoundCloud="0";
                    }
                    $finalResult[] = array('user_id' =>$userDetails->id,'user_email' =>$userDetails->user_email,'user_name' =>$userDetails->user_name,'user_type' =>$userDetails->user_type,'name' =>$name,'auth_key' =>$userDetails->auth_key,'profile_pic' =>$ProfileUrl,'soundcloud_url'=>$SoundCloud);
                }                
                return Response::json(array('status' => "success",'follow_list'=> $finalResult), 200);
            }else {
                return Response::json(array('status' => "success",'follow_list'=> array()), 200);
            }            
        }
            
    }
    //Gleams  Follow List ends here

    //Gleams  Following List starts here
    public static function followingList($input) {
        $validation = Validator::make($input, Users::$getallmessageRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        }else {
            $userId = $input['user_id'];
            $followingListcount =  DB::select("SELECT * FROM follow_table WHERE follow RLIKE  '[[:<:]]".$userId."[[:>:]]'");
            if(count($followingListcount)>0){
                foreach ($followingListcount as &$value) { 
                    $userDetails = DB::table('socialite_user')->select('id','user_email','user_name','auth_key','profile_pic','user_type')->where('id', $value->id)->first();
                    $indTable = DB::table($userDetails->user_type.'_user')->where('id', $value->id)->first();
                    if($userDetails->user_type=="enthusiastic" OR $userDetails->user_type=="host" OR $userDetails->user_type=="artist")
                    { $name=$indTable->first_name; }
                    else{
                        $er=$userDetails->user_type."_name";
                        $name=$indTable->$er;
                    }
                    $ProfileImageUrl = strpos($userDetails->profile_pic, 'https://');
                    if ($ProfileImageUrl !== false) {
                        $ProfileUrl=$$userDetails->profile_pic; 
                    } else {
                        $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$userDetails->profile_pic;
                    }
                    if($userDetails->user_type=="artist"){
                        $SoundCloud=$indTable->soundcloud_url;
                    }else{
                        $SoundCloud="0";
                    }
                    $finalResult[] = array('user_id' =>$userDetails->id,'user_email' =>$userDetails->user_email,'user_name' =>$userDetails->user_name,'user_type' =>$userDetails->user_type,'name' =>$name,'auth_key' =>$userDetails->auth_key,'profile_pic' =>$ProfileUrl,'soundcloud_url'=>$SoundCloud);
                }                
                return Response::json(array('status' => "success",'follow_list'=> $finalResult), 200);
            }else {
                return Response::json(array('status' => "success",'follow_list'=> array()), 200);
            } 
            return Response::json(array('status' => "success",'follow_list'=> count($followingListcount)), 200);         
        }
            
    }
    //Gleams  Following List ends here

    //Gleams  mutualFollow starts here
    public static function mutualFollow($input) {
        $validation = Validator::make($input, Users::$getallmessageRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        }else {
            $userId = $input['user_id'];
            $finalList = array();
            $sql= DB::table('follow_table')->where('id', $userId)->first();
            if(count($sql)>0){
                $follow=$sql->follow;
                $type=explode(',',$follow);
                foreach ($type as &$value) {
                    $sql1= DB::select("SELECT * FROM follow_table WHERE follow RLIKE  '[[:<:]]".$userId."[[:>:]]' AND id='".$value."'");
                    if(count($sql1)>0){
                        $sql_name= DB::table('socialite_user')->where('id', $value)->first();
                        $finalList[] = array('user_id' =>$sql_name->id,'user_name' =>$sql_name->user_name,'profile_pic' =>$sql_name->profile_pic,'user_type' =>$sql_name->user_type);  
                        //unset($type);
                    }   
                }
                return Response::json(array('status' => "success",'mutual_follow_list'=> $finalList), 200); 
            } else {
                return Response::json(array('status' => "success",'mutual_follow_list'=> array()), 200);
            }
             
        }
            
    }
    //Gleams  mutualFollow ends her

    //Gleams  like post starts here gleamsadvLike
    public static function gleamsLike($input) {
        $validation = Validator::make($input, Users::$gleamsLikeRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $postId = $input['post_id'];
            $likeListcount= DB::table('gleams_likes')->where('post_id', $postId)->count();
            if($likeListcount>0){
                $likeList= DB::table('gleams_likes')->where('post_id', $postId)->first();
                $updatedlikeValue = $likeList->post_likes. ",".$userId;
                DB::table('gleams_likes')->where('post_id', $postId)->update(['post_likes' => $updatedlikeValue]);                
                $receiverId = DB::table('gleams_post')->select('user_id')->where('post_id', $postId)->first();
                $devicetokenUser = DB::table('socialite_user')->select('device_token')->where('id', $receiverId->user_id)->first();
                $senderdetails = DB::table('socialite_user')->where('id', $userId)->first();
                if($userId!=$receiverId->user_id){
                     DB::table('gleams_notification')->insertGetId(
                        array(
                            'sender' => $userId,
                            'receiver' => $receiverId->user_id,
                            'notifier_type' => 'like',
                            'message' => '',
                            'post_id' => $postId,
                            'status' => '0'
                        )
                    );
                    $pushnotDetails = DB::table('gleams_post')
                    ->join('socialite_user', 'gleams_post.user_id', '=', 'socialite_user.id')
                    ->select('gleams_post.*', 'socialite_user.*')->where('gleams_post.post_id',$postId)
                    ->get();
                    $ProfileImageUrl = strpos($senderdetails->profile_pic, 'https://');
                    if ($ProfileImageUrl !== false) {
                        $ProfileUrl=$senderdetails->profile_pic; 
                    } else {
                        $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$senderdetails->profile_pic;
                    } 
                    //Do Push Notificartion code
                }
                if($devicetokenUser->device_token !=' '){
                    Users::PushNotification($userId,$senderdetails->auth_key,$senderdetails->user_name,'like',$postId,$devicetokenUser->device_token,$ProfileUrl);                                    
                }
                return Response::json(array('status' => "Success"), 200);
            }else {
                DB::table('gleams_likes')->insertGetId(
                        array(
                            'post_id' => $postId,
                            'post_likes' => $userId
                        )
                    );
                $receiverId = DB::table('gleams_post')->select('user_id')->where('post_id', $postId)->first();
                $devicetokenUser = DB::table('socialite_user')->select('device_token')->where('id', $receiverId->user_id)->first();
                $senderdetails = DB::table('socialite_user')->where('id', $userId)->first();
                if($userId!=$receiverId->user_id){                    
                    DB::table('gleams_notification')->insertGetId(
                        array(
                            'sender' => $userId,
                            'receiver' => $receiverId->user_id,
                            'notifier_type' => 'like',
                            'message' => '',
                            'post_id' => $postId,
                            'status' => '0'
                        )
                    );
                    $pushnotDetails = DB::table('gleams_post')
                    ->join('socialite_user', 'gleams_post.user_id', '=', 'socialite_user.id')
                    ->select('gleams_post.*', 'socialite_user.*')->where('gleams_post.post_id',$postId)
                    ->get();
                    $ProfileImageUrl = strpos($senderdetails->profile_pic, 'https://');
                    if ($ProfileImageUrl !== false) {
                        $ProfileUrl=$senderdetails->profile_pic; 
                    } else {
                        $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$senderdetails->profile_pic;
                    } 
                    //Do Push Notificartion code
                }
                if($devicetokenUser->device_token !=' '){
                    Users::PushNotification($userId,$senderdetails->auth_key,$senderdetails->user_name,'like',$postId,$devicetokenUser->device_token,$ProfileUrl);                                                    
                }
                return Response::json(array('status' => "Success"), 200);
            }    
        }       
    }
    //Gleams  like post ends her 

    //Gleams  gleamsUnlike starts here
    public static function gleamsUnlike($input) {
        $validation = Validator::make($input, Users::$gleamsLikeRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $postId = $input['post_id'];
            $likeListcount= DB::table('gleams_likes')->where('post_id', $postId)->count();
            if($likeListcount>0){
                $receiverId = DB::table('gleams_post')->select('user_id')->where('post_id', $postId)->first();
                $devicetokenUser = DB::table('socialite_user')->select('device_token')->where('id', $receiverId->user_id)->first();
                $senderdetails = DB::table('socialite_user')->where('id', $userId)->first();
                $ProfileImageUrl = strpos($senderdetails->profile_pic, 'https://');
                    if ($ProfileImageUrl !== false) {
                        $ProfileUrl=$senderdetails->profile_pic; 
                    } else {
                        $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$senderdetails->profile_pic;
                    } 
                $likeList= DB::table('gleams_likes')->where('post_id', $postId)->first();
                $likesId=explode(",",$likeList->post_likes);
                $likesId=array_diff($likesId, array($userId));
                if(count($likesId)==0){
                     DB::table('gleams_likes')->where('post_id', $postId)->delete();
                     if($devicetokenUser->device_token !=' '){
                        Users::PushNotification($userId,$senderdetails->auth_key,$senderdetails->user_name,'unlike',$postId,$devicetokenUser->device_token,$ProfileUrl);                                                    
                    }
                     return Response::json(array('status' => "Success"), 200);
                } else {
                    $likesId=implode(",",$likesId);
                    DB::table('gleams_likes')->where('post_id', $postId)->update(['post_likes' => $likesId]);
                    if($devicetokenUser->device_token !=' '){
                        Users::PushNotification($userId,$senderdetails->auth_key,$senderdetails->user_name,'unlike',$postId,$devicetokenUser->device_token,$ProfileUrl);                                                    
                    }
                    return Response::json(array('status' => "Success"), 200);
                }
            }else {
                return Response::json(array('status' => "Error", "msg" => "Sorry something went wrong"), 200);
            }    
        }       
    }
    //Gleams  gleamsUnlike ends her

    //Gleams  gleamsadvLike starts here 
    public static function gleamsadvLike($input) {
        $validation = Validator::make($input, Users::$gleamsLikeRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $postId = $input['post_id'];
            $likeListcount= DB::table('gleams_likes_adv')->where('post_id', $postId)->count();
            if($likeListcount>0){
                $likeList= DB::table('gleams_likes_adv')->where('post_id', $postId)->first();
                $updatedlikeValue = $likeList->post_likes. ",".$userId;
                DB::table('gleams_likes_adv')->where('post_id', $postId)->update(['post_likes' => $updatedlikeValue]);                                 
                return Response::json(array('status' => "Success"), 200);
            }else {
                DB::table('gleams_likes_adv')->insertGetId(
                        array(
                            'post_id' => $postId,
                            'post_likes' => $userId
                        )
                    );                
                return Response::json(array('status' => "Success"), 200);
            }    
        }       
    }
    //Gleams  gleamsadvLike ends her 

    //Gleams  gleamsadvLike starts here gleamsGallery
    public static function gleamsadvunLike($input) {
        $validation = Validator::make($input, Users::$gleamsLikeRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $postId = $input['post_id'];
            $likeListcount= DB::table('gleams_likes_adv')->where('post_id', $postId)->count();
            if($likeListcount>0){
                $likeList= DB::table('gleams_likes_adv')->where('post_id', $postId)->first();
                $likesId=explode(",",$likeList->post_likes);
                $likesId=array_diff($likesId, array($userId));
                if(count($likesId)==0){
                     DB::table('gleams_likes_adv')->where('post_id', $postId)->delete();
                     return Response::json(array('status' => "Success"), 200);
                } else {
                    $likesId=implode(",",$likesId);
                    DB::table('gleams_likes_adv')->where('post_id', $postId)->update(['post_likes' => $likesId]);
                    return Response::json(array('status' => "Success"), 200);
                }
            }else {
                return Response::json(array('status' => "Success", "msg" => "Sorry something went wrong"), 200);
            }    
        }       
    }
    //Gleams  gleamsadvLike ends her

    /*Gleams  gleamsGallery starts here 
    public static function gleamsGallery($input) {
        $validation = Validator::make($input, Users::$gleamsLikeRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $postId = $input['post_id'];
            $likeListcount= DB::table('gleams_likes_adv')->where('post_id', $postId)->count();
            if($likeListcount>0){
                $likeList= DB::table('gleams_likes_adv')->where('post_id', $postId)->first();
                $likesId=explode(",",$likeList->post_likes);
                $likesId=array_diff($likesId, array($userId));
                if(count($likesId)==0){
                     DB::table('gleams_likes_adv')->where('post_id', $postId)->delete();
                     return Response::json(array('status' => "Success"), 200);
                } else {
                    $likesId=implode(",",$likesId);
                    DB::table('gleams_likes_adv')->where('post_id', $postId)->update(['post_likes' => $likesId]);
                    return Response::json(array('status' => "Success"), 200);
                }
            }else {
                return Response::json(array('status' => "Success", "msg" => "Sorry something went wrong"), 200);
            }    
        }       
    }*/
    //Gleams  gleamsGallery ends her

    //Gleams  gleamsGalleryshow starts here 
    public static function gleamsGalleryshow($input) {
        $validation = Validator::make($input, Users::$galleryshowRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_ID'];
            $galleryImagesCount= DB::table('gleams_gallery')->where('user', $userId)->count();
            if($galleryImagesCount>0){
                $galleryImages= DB::table('gleams_gallery')->where('user', $userId)->get();
                foreach ($galleryImages as &$value) { 
                    $imgSrc = "http://gleamedm.com/reb/img/post/".$value->image_url;
                    $imageResult[] = array('gallery_id'=>$value->gal_id,'imgage'=>$imgSrc);
                }
                return Response::json(array('status' => "Success",'gallery' => $imageResult), 200);
            }else {
                return Response::json(array('status' => "No Gallery images found !"), 200);
            }    
        }       
    }
    //Gleams  gleamsGalleryshow ends her

    //Gleams  messageperPerson starts here 
    public static function messageperPerson($input) {
        $validation = Validator::make($input, Users::$messageperPersonRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $indId = $input['individual_id'];
            $senderDetails = DB::table('socialite_user')->where('id', $indId)->first();
            $receiverDetails = DB::table('socialite_user')->where('id', $userId)->first();
            $Messages = DB::select("SELECT * FROM  `gleams_message` WHERE (`user_id` =".$userId." AND  `receiver_id` =".$indId.") OR (`user_id` =".$indId." AND  `receiver_id` =".$userId.") ORDER BY  `gleams_message`.`msg_id` ASC");
            if(count($Messages)>0){
                $ProfileImageUrl = strpos($senderDetails->profile_pic, 'https://');
                if ($ProfileImageUrl !== false) {
                    $ProfileUrl=$senderDetails->profile_pic; 
                } else {
                    $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$senderDetails->profile_pic;
                }
                $ProfileImageUrlReceiver = strpos($receiverDetails->profile_pic, 'https://');
                if ($ProfileImageUrlReceiver !== false) {
                    $ProfileUrlReceiver=$receiverDetails->profile_pic; 
                } else {
                    $ProfileUrlReceiver='http://gleamedm.com/reb/img/fans/profile_pic/'.$receiverDetails->profile_pic;
                }
                date_default_timezone_set("UTC");                
                return Response::json(array('status' => "Success",'server_time'=>date('Y-m-d H:i:s'),'user_email' =>$senderDetails->user_email,'user_name' =>$senderDetails->user_name,'profile_pic' =>$ProfileUrl,'user_name_receiver'=>$receiverDetails->user_name,'profile_pic_receiver'=>$ProfileUrlReceiver,'message' => $Messages), 200);
            }else {
                return Response::json(array('status' => "No Message Found !"), 200);
            }   
        }       
    }
    //Gleams  messageperPerson ends her

    //Gleams  gleamsCommenting starts here 
    public static function gleamsCommenting($input) {
        $validation = Validator::make($input, Users::$gleamsCommentingRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $postId = $input['message_id'];
            $comment = $input['comment'];
            DB::table('gleams_comment')->insertGetId(
                    array(
                        'message_id' => $postId,
                        'user_id' => $userId,
                        'comment' => $comment
                    )
                );
            $receiverId = DB::table('gleams_post')->select('user_id')->where('post_id', $postId)->first();
            $devicetokenUser = DB::table('socialite_user')->select('device_token')->where('id', $receiverId->user_id)->first();
            $senderdetails = DB::table('socialite_user')->where('id', $userId)->first();
            if($userId!=$receiverId->user_id){                    
                    DB::table('gleams_notification')->insertGetId(
                        array(
                            'sender' => $userId,
                            'receiver' => $receiverId->user_id,
                            'notifier_type' => 'comment',
                            'message' => $comment,
                            'post_id' => $postId,
                            'status' => '0'
                        )
                    );
                $pushnotDetails = DB::table('gleams_post')
                ->join('socialite_user', 'gleams_post.user_id', '=', 'socialite_user.id')
                ->select('gleams_post.*', 'socialite_user.*')->where('gleams_post.post_id',$postId)
                ->get();
                $ProfileImageUrl = strpos($senderdetails->profile_pic, 'https://');
                if ($ProfileImageUrl !== false) {
                    $ProfileUrl=$senderdetails->profile_pic; 
                } else {
                    $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$senderdetails->profile_pic;
                } 
                //Do Push Notificartion code 
                if($devicetokenUser->device_token !=' '){
                    Users::PushNotification($userId,$senderdetails->auth_key,$senderdetails->user_name,'commenting',$postId,$devicetokenUser->device_token,$ProfileUrl);
                }                  
            }
            //Users::PushNotification($userId,$senderdetails->auth_key,$senderdetails->user_name,'like',$postId,$devicetokenUser->device_token,$ProfileUrl);                                                    
            return Response::json(array('status' => "Success"), 200);
        }       
    }
    //Gleams  gleamsCommenting ends her

    //Gleams  gleamsadvCommenting starts here 
    public static function gleamsadvCommenting($input) {
        $validation = Validator::make($input, Users::$gleamsCommentingRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $postId = $input['message_id'];
            $comment = $input['comment'];
            DB::table('gleams_comment_adv')->insertGetId(
                    array(
                        'message_id' => $postId,
                        'user_id' => $userId,
                        'comment' => $comment
                    )
                );                    
            return Response::json(array('status' => "Success"), 200);
        }       
    }
    //Gleams  gleamsadvCommenting ends her

    //Gleams  gleamsinsertNotify starts here 
    public static function gleamsinsertNotify($input) {
        $validation = Validator::make($input, Users::$gleamsinsertNotifyRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $message=$input['message'];
            $userId=$input['user_id'];
            $notifyId=$input['notify_id'];
            $notifierType=$input['notifier_type'];
            DB::table('gleams_notification')->insertGetId(
                    array(
                        'sender' => $userId,
                        'receiver' => $notifyId,
                        'notifier_type' => $notifierType,
                        'message' => $message
                    )
                );                    
            return Response::json(array('status' => "Success"), 200);
        }       
    }
    //Gleams  gleamsinsertNotify ends her 

    //Gleams  gleamsNotification starts here 
    public static function gleamsNotification($input) {
        $validation = Validator::make($input, Users::$gleamsNotificationRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $notifyId=$input['notify_id'];
            $fullnotList = array();
            $Result = array();
            $notCount = DB::table('gleams_notification')->where('receiver', $notifyId)->where('status', 0)->count();
            $fullnotList = DB::table('gleams_notification')->where('receiver', $notifyId)->orderBy('id' , 'DESC')->get();
            $dd=count($fullnotList);
            if(count($fullnotList)>0){
                foreach($fullnotList as $split){
                    $senderDet = DB::table('socialite_user')->where('id', $split->sender)->first();
                    $ProfileImageUrl = strpos($senderDet->profile_pic, 'https://');
                    if ($ProfileImageUrl !== false) {
                        $ProfileUrl=$senderDet->profile_pic; 
                    } else {
                        $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$senderDet->profile_pic;
                    }
                    $Result[] = array('not_id'=>$split->id,'user_name'=>$senderDet->user_name,'user_id'=>$senderDet->id,'auth_key'=>$senderDet->auth_key, 'profile_pic'=>$ProfileUrl,'notifier_type'=>$split->notifier_type,'post_id'=>$split->post_id,'message'=>$split->message,'time_stamp'=>$split->time_stamp,'status'=>$split->status);                
                }                
            } 
            return Response::json(array('status' => "Success",'count'=>$notCount,'result' =>$Result), 200);
        }       
    }
    //Gleams  gleamsNotification ends here notificationStatus

    //Gleams  notificationStatus starts here 
    public static function notificationStatus($input) {
        $validation = Validator::make($input, Users::$gleamsNotificationRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $notifyId=$input['notify_id'];
            $Notify=explode(",",$notifyId);
            $tr=0;
            $sam=0;
            for($i=$tr; $i<count($Notify); $i++){
                $notID=$Notify[$i]; 
                DB::table('gleams_notification')->where('id', $notID)->update(['status' => 1]);                
                $sam=1;
            }
            if($sam==1){
                return Response::json(array('status' => 'Success'), 200);
            }
            else{
                return Response::json(array('status' => 'Error'), 200);
            }            
        }       
    }
    //Gleams  notificationStatus ends here 

    //Gleams  notificationstausChange starts here 
    public static function notificationstausChange($input) {
        $validation = Validator::make($input, Users::$nsChangeRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $usreId = $input['user_id'];
            DB::table('gleams_notification')->where('id', $usreId)->update(['status' => 1]);                                
            return Response::json(array('status' => 'Success'), 200);                
        }       
    }
    //Gleams  notificationstausChange ends here 

    //Gleams  postlikeList starts here 
    public static function postlikeList($input) {
        $validation = Validator::make($input, Users::$postlikeListRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $postId = $input['post_id'];
            $postLikeListcount = DB::table('gleams_likes')->where('post_id', $postId)->count();
            if($postLikeListcount>0){
                $postLikeList = DB::table('gleams_likes')->where('post_id', $postId)->first();
                $likeList=explode("," , $postLikeList->post_likes);
                foreach($likeList as &$value){
                    $userData = DB::table('socialite_user')->where('id', $value)->first();
                    $Result[] = array('user_id'=>$userData->id,'user_name'=>$userData->user_name,'auth_key'=>$userData->auth_key);                
                }
                return Response::json(array('status' => 'Success','post_like'=>$Result), 200);
            } else {
                return Response::json(array('status' => 'Fail'), 200);
            }                                                           
        }       
    }
    //Gleams  postlikeList ends here 

    //Gleams  advpostlikeList starts here 
    public static function advpostlikeList($input) {
        $validation = Validator::make($input, Users::$postlikeListRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $postId = $input['post_id'];
            $postLikeListcount = DB::table('gleams_likes_adv')->where('post_id', $postId)->count();
            if($postLikeListcount>0){
                $postLikeList = DB::table('gleams_likes_adv')->where('post_id', $postId)->first();
                $likeList=explode("," , $postLikeList->post_likes);
                foreach($likeList as &$value){
                    $userData = DB::table('socialite_user')->where('id', $value)->first();
                    $Result[] = array('user_id'=>$userData->id,'user_name'=>$userData->user_name,'auth_key'=>$userData->auth_key);                
                }
                return Response::json(array('status' => 'Success','post_like'=>$Result), 200);
            } else {
                return Response::json(array('status' => 'Fail'), 200);
            }                                                           
        }       
    }
    //Gleams  advpostlikeList ends here 

    //Gleams  commentedUsers starts here 
    public static function commentedUsers($input) {
        $validation = Validator::make($input, Users::$postlikeListRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $postId = $input['post_id'];
            $Result = array();
            $commentedUsers = DB::select("SELECT DISTINCT `user_id` FROM `gleams_comment` WHERE `message_id` =".$postId."");
            if(count($commentedUsers)>0){
                foreach($commentedUsers as $value){
                    $userData = DB::table('socialite_user')->where('id', $value->user_id)->first();
                    $Result[] = array('user_id'=>$userData->id,'user_name'=>$userData->user_name,'auth_key'=>$userData->auth_key);
                }
                return Response::json(array('status' => 'Success','commenters_list'=>$Result), 200);
            } else {
                return Response::json(array('status' => 'Fail','commenters_list'=>$Result), 200);
            }                                                       
        }       
    }
    //Gleams  commentedUsers ends here  

    //Gleams  commentedadvUsers starts here 
    public static function commentedadvUsers($input) {
        $validation = Validator::make($input, Users::$postlikeListRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $postId = $input['post_id'];
            $Result = array();
            $commentedUsers = DB::select("SELECT DISTINCT `user_id` FROM `gleams_comment_adv` WHERE `message_id` =".$postId."");
            if(count($commentedUsers)>0){
                foreach($commentedUsers as $value){
                    $userData = DB::table('socialite_user')->where('id', $value->user_id)->first();
                    $Result[] = array('user_id'=>$userData->id,'user_name'=>$userData->user_name,'auth_key'=>$userData->auth_key);
                }
                return Response::json(array('status' => 'Success','commenters_list'=>$Result), 200);
            } else {
                return Response::json(array('status' => 'Fail','commenters_list'=>$Result), 200);
            }                                                       
        }       
    }
    //Gleams  commentedadvUsers ends here 

    //Gleams  messageCount starts here 
    public static function messageCount($input) {
        $validation = Validator::make($input, Users::$nsChangeRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $notCount = DB::table('gleams_message')->where('receiver_id', $userId)->where('status', 0)->count();
            return Response::json(array('status' => 'Success','message_count'=>$notCount), 200);                                                                
        }       
    }
    //Gleams  messageCount ends here 

    //Gleams  updateDevicetoken starts here 
    public static function updateDevicetoken($input) {
        $validation = Validator::make($input, Users::$udvRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $deviceToken = $input['device_token'];
            DB::table('socialite_user')->where('id', $userId)->update(['device_token' => $deviceToken]);
            return Response::json(array('status' => 'Success'), 200);                                                                
        }       
    }
    //Gleams  updateDevicetoken ends here gleamsuserData

    //Gleams  gleamsuserData starts here 
    public static function gleamsuserData($input) {
        $validation = Validator::make($input, Users::$gleamsuserDataRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id'];
            $userType = $input['user_type'];
            $pushnotDetails = DB::table('socialite_user')
                    ->join($userType.'_user', 'socialite_user.id', '=', $userType.'_user.id')
                    ->select('socialite_user.*', $userType.'_user.*')->first();
            return Response::json(array('status' => $pushnotDetails), 200);                                                                
        }       
    }
    //Gleams  gleamsuserData ends here forgotPassword

    //Gleams  requestVip starts here 
    public static function requestVip($input) {
        $validation = Validator::make($input, Users::$requestVipRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['id'];
            $email = $input['email'];
            $budget = $input['budget'];
            $people = $input['people'];
            $Pnumber = $input['pnumber'];
            $name = $input['name'];
            $userDetail = DB::table('socialite_user')->select('user_email' , 'user_name')->where('id', $userId)->first();
            $USersName = ucfirst($userDetail->user_name);
            $to = $userDetail->user_email;
                $subject = "VIP ticket request from Gleams APP";
                $txt = '<html>
            <head>
                <style type="text/CSS">
                    body, #body_style {
                        background:#ffb000; 
                        min-height:300px; 
                        color:#fff; 
                        font-family:Arial, Helvetica, sans-serif; 
                        font-size:18px;} 
                     table { 
            color: #333; /* Lighten up font color */
            font-family: Helvetica, Arial, sans-serif; /* Nicer font */ 
            border-collapse: 
            collapse; border-spacing: 0; 
            }

            td, th { border: 1px solid #CCC; height: 30px; padding:10px;} /* Make cells a bit taller */

            th {
            background: #F3F3F3; /* Light grey background */
            font-weight: bold; /* Make sure theyre bold */
            }

            td {
            background: #FAFAFA; /* Lighter grey background */
            text-align: center; /* Center our text */
            }
                    .ExternalClass {width:100%;}
                    .yshortcuts {color: #F00;}
                    p {margin:0; padding:0; margin-bottom:0;} /*optional*/
                    a, a:link, a:visited {color:#2A5DB0;} /*optional*/
                </style>
            </head>

            <body style="background:#ffb000; min-height:300px; color:#fff;font-family:Arial, Helvetica, sans-serif; 
               font-size:14px" alink="#FF0000" link="#FF0000" bgcolor="#ffb000" text="#FFFFFF"> 
                <span id="body_style" style="padding:10px; display:block"> Hi '.$USersName.',</span>
                <span id="body_style" style="padding:15px; display:block"> 
                   
                    <p>What is Gleam? Gleam is a movement. Gleam is a community where electronic music aficionados and industry professionals alike come interact, share and grow together. </p><br /><p>

            Gleam enables you to be in constant communication with electronic music enthusiasts and artists, stay informed of new music and purchase tickets to the best events and festivals around the globe.</p>

                    <br /> <br />
                        <table bgcolor="#ffb000" width="900">
                                    <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Budget</th>
                                    <th>Number Of People</th>
                                    <th>Phone Number</th>
                                    </tr>
                                    <tr>
                                    <td>'.$name.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$budget.'</td>
                                    <td>'.$people.'</td>
                                    <td>'.$name.'</td>
                                    </tr>
                                    </table>
               
                </span>
                    <br /><span id="body_style" style="padding:10px; display:block">Many Thanks, <br />
                    Gleams Team</span><br />
                    <a href="http://gleamedm.com/" style="color:#FFF"><img src="http://gleamedm.com/images/gleam_logo.png" width="200" height="100" style="float:right;"/></a>
                    
            </body>
            </html>';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: ". $email."" . "\r\n" .
            "CC: sreejith.sagar@gmail.com";
            mail($to,$subject,$txt,$headers);
            return Response::json(array( "msg" => "Success"), 200);                                                                
        }       
    }
    //Gleams  requestVip ends here

    //Gleams  forgotPassword starts here 
    public static function forgotPassword($input) {
        $validation = Validator::make($input, Users::$forgotPasswordRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $email = $input['email'];
            $fPass = DB::table('socialite_user')->select('user_email' , 'auth_key')->where('user_email', $email)->first();
            if(count($fPass)){
                    $auth_key=$fPass->auth_key;
                    $to = $email;
                    $subject = "Reset Password";
                    $message = "Pleas click the link to rest your password http://gleamedm.com/reset_password/reset_password.php?auth_key=".$auth_key;              
                    $headers = 'From: reset_password@gleamedm.com' . "\r\n" .
                        'Reply-To: reset_password@gleamedm.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    $retval = mail($to, $subject, $message, $headers);
                    if( $retval == true )  
                    {
                        return Response::json(array('msg' => 'Email Exist','notification' => 'Please check your email account to reset your password','auth_key' => '$auth_key','send mail'=>'Suceess'), 200);
                    }
                    else
                    {
                      return Response::json(array('status' => 'Error'), 200);
                    }
                    
            } else {
                return Response::json(array('status' => 'Error'), 200);
            }                                                                        
        }       
    }
    //Gleams  forgotPassword ends here 

    //Gleams  nearestEvents starts here 
    public static function nearestEvents($input) {
        $validation = Validator::make($input, Users::$nearestEventsRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $lat1 = $input['latitude'];
            $lon1 = $input['longitude'];
            $d = $input['distance'];
            $userId= $input['user_id'];
            $FinalResult= array();
            $NearesrAdvData= array();
            $NearesrAdvRes = array();
            $ResultEvent=array();
            $rlt1 = DB::select("SELECT * FROM (SELECT * , (((ACOS( SIN( ( ".$lat1." * PI( ) /180 ) ) * SIN( (latitude * PI( ) /180 ) ) + COS( ( ".$lat1." * PI( ) /180 ) ) * COS( (latitude * PI( ) /180 )) * COS( ((".$lon1." - longitude) * PI( ) /180 )))) *180 / PI( )) *60 * 1.1515) AS distance FROM venue_user) AS X WHERE distance <".$d." ORDER BY distance ASC");
            $rlt = DB::select("SELECT * FROM (SELECT * , (((ACOS( SIN( ( ".$lat1." * PI( ) /180 ) ) * SIN( (latitude * PI( ) /180 ) ) + COS( ( ".$lat1." * PI( ) /180 ) ) * COS( (latitude * PI( ) /180 )) * COS( ((".$lon1." - longitude) * PI( ) /180 )))) *180 / PI( )) *60 * 1.1515) AS distance FROM event_user) AS X WHERE distance <".$d." ORDER BY distance ASC");            
            $NearesrAdvRes = DB::select("SELECT * FROM (SELECT * , (((ACOS( SIN( ( ".$lat1." * PI( ) /180 ) ) * SIN( (lat * PI( ) /180 ) ) + COS( ( ".$lat1." * PI( ) /180 ) ) * COS( (lat * PI( ) /180 )) * COS( ((".$lon1." - lon) * PI( ) /180 )))) *180 / PI( )) *60 * 1.1515) AS distance FROM nearest_adv) AS X WHERE distance <".$d." ORDER BY distance ASC");
            $FollowResult = DB::table('follow_table')->where('id', $userId)->first();
            $MyFollow=explode(",",$FollowResult->follow);
            if(count($NearesrAdvRes)>0){
                foreach($NearesrAdvRes as $NearesrAdvRes){
                    $SiteDetailsRes = DB::table('nearest_adv_site')->where('ID', $NearesrAdvRes->adv_id)->first();
                    if(empty($NearesrAdvRes->image_url)){
                        $ImageWH=array('im_width'=>'0','im_height'=>'0');
                    } else {
                        $post_image=$NearesrAdvRes->image_url;
                        list($width, $height) = getimagesize($post_image);
                    }
                    $NearesrAdvData[]= array('adv_id'=>$NearesrAdvRes->adv_id,'user_name'=>$NearesrAdvRes->user_name,'site_url'=>$NearesrAdvRes->site_url,'message'=>$NearesrAdvRes->message,'image_url'=>$NearesrAdvRes->image_url,'profile_pic'=>'http://gleamedm.com/reb/adv/default.jpg','im_width'=>$width,'im_height'=>$height,'address'=>$NearesrAdvRes->address,'phone'=>$NearesrAdvRes->phone,'lat'=>$NearesrAdvRes->lat,'lon'=>$NearesrAdvRes->lon,'distance'=>$NearesrAdvRes->distance,'time_stamp'=>$NearesrAdvRes->time_stamp,'site_details'=>$SiteDetailsRes);                        
                }
            }
            if(count($rlt)>0){
                foreach($rlt as $rlt){
                    if (in_array($rlt->id, $MyFollow)){ $IsFollowing="1"; } else{ $IsFollowing="0"; }
                    if(empty($rlt->follow)){ $Follow=array(); } else { $Follow=explode(",",$rlt->follow); }
                    $VenuekeyResCount = DB::table('socialite_user')->where('id', $rlt->id)->count();
                    if($VenuekeyResCount>0){
                        $VenuekeyRes = DB::table('socialite_user')->where('id', $rlt->id)->first();
                        $ResultEvent[]=array("id"=>$rlt->id,"venue_name"=>$rlt->event_name,"auth_key"=>$VenuekeyRes->auth_key,"full_name"=>$rlt->event_name,"usre_type"=>$VenuekeyRes->user_type,"about"=>$rlt->about,"profile_pic"=>$rlt->profile_pic,"cover_pic"=>$rlt->cover_pic,"address"=>$rlt->address,"phone"=>" ","follow"=>$Follow,"is_following"=>$IsFollowing,"distance"=>$rlt->distance,"latitude"=>$rlt->latitude,"longitude"=>$rlt->longitude);                            
                    }
                }
            }
            if(count($rlt1)>0){
                foreach($rlt1 as $rlt1){
                    if (in_array($rlt1->id, $MyFollow)){ $IsFollowing="1"; } else{ $IsFollowing="0"; }
                    if(empty($rlt1->follow)){ $Follow=array(); } else { $Follow=explode(",",$rlt1->follow); }
                    $EventRes = DB::table('socialite_user')->where('id', $rlt1->id)->count();
                    if($EventRes>0){
                        $EventkeyRes = DB::table('socialite_user')->where('id', $rlt1->id)->first();
                        $Result[]=array("id"=>$rlt1->id,"venue_name"=>$rlt1->venue_name,"auth_key"=>$EventkeyRes->auth_key,"full_name"=>$rlt1->venue_name,"usre_type"=>$EventkeyRes->user_type,"about"=>$rlt1->about,"profile_pic"=>$rlt1->profile_pic,"cover_pic"=>$rlt1->cover_pic,"address"=>$rlt1->address,"phone"=>" ","follow"=>$Follow,"is_following"=>$IsFollowing,"distance"=>$rlt1->distance,"latitude"=>$rlt1->latitude,"longitude"=>$rlt1->longitude);
                
                    }
                }
            }
            $FinalResult = array_merge($Result, $ResultEvent);
            return Response::json(array('status' => "Success", "msg" => "Found nearest Events",'nearest_adv'=>$NearesrAdvData,'event_details'=>$FinalResult), 200);                                                                                   
        }       
    }

    //Gleams  gleamsGallery ends here
    public static function gleamsGallery($input) {
        $validation = Validator::make($input, Users::$gleamsGalleryRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $gallery=$input['gallery'];
            $user_id=$input['user_id'];
            foreach ($gallery as $value) {
                $hi=$value['gallery_pic'];
                $img = str_replace('data:image/png;base64,', '', $hi);
                $filename = substr(time(), 0, 15).str_random(30);
                $success= file_put_contents('../reb/img/post/'.$filename.'.jpg', base64_decode($img)); 
                if($success){
                    $filenameFinal = $filename."jpg";
                    DB::table('gleams_gallery')->insertGetId(
                    array(
                        'user' => $user_id,
                        'image_url' => $filenameFinal
                        )
                    ); 
                    return Response::json(array('status' => "Success"), 200);              
                } else{
                    return Response::json(array('status' => "Error"), 200);
                }
            }    
        }
            
    }

    //Gleams  gleamsGallery ends here

    //Gleams  updarepersonalInfo starts here
    public static function updatepersonalInfo($input) {
        $validation = Validator::make($input, Users::$updatepersonalInfo);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $auth_key=$input['auth_key'];
            $first_name=$input['first_name'];
            $last_name=$input['last_name'];
            $about=$input['about'];
            $profile_pic=$input['profile_pic'];
            $cover_pic=$input['cover_pic'];
            $UserCount = DB::table('socialite_user')->where('auth_key', $auth_key)->count();
            if(empty($profile_pic) AND empty($cover_pic) AND $UserCount>0){
                $UserData = DB::table('socialite_user')->where('auth_key', $auth_key)->first();
                DB::table('enthusiastic_user')->where('id', $UserData->id)->update(['first_name' => $first_name]); 
                return Response::json(array('msg' => "updated"), 200);
            } elseif(empty($profile_pic) AND !empty($cover_pic) AND $UserCount>0){
                $UserData = DB::table('socialite_user')->where('auth_key', $auth_key)->first();
                $img = str_replace('data:image/png;base64,', '', $cover_pic);
                $filename = substr(time(), 0, 15).str_random(30);
                $success= file_put_contents('../reb/img/fans/cover_pic/'.$filename.'.jpg', base64_decode($img));
                DB::table('enthusiastic_user')->where('id', $UserData->id)->update(['first_name' => $first_name]);
                DB::table('socialite_user')->where('id', $UserData->id)->update(['cover_pic' => $filename.'.jpg']);
                return Response::json(array('msg' => "updated"), 200);
            }elseif(!empty($profile_pic) AND empty($cover_pic) AND $UserCount>0){
                $UserData = DB::table('socialite_user')->where('auth_key', $auth_key)->first();
                $img = str_replace('data:image/png;base64,', '', $profile_pic);
                $filename = substr(time(), 0, 15).str_random(30);
                $success= file_put_contents('../reb/img/fans/profile_pic/'.$filename.'.jpg', base64_decode($img));
                DB::table('enthusiastic_user')->where('id', $UserData->id)->update(['first_name' => $first_name]);
                DB::table('socialite_user')->where('id', $UserData->id)->update(['profile_pic' => $filename.'.jpg']);
               return Response::json(array('msg' => "updated"), 200); 
            }elseif(!empty($profile_pic) AND !empty($cover_pic) AND $UserCount>0){
                $UserData = DB::table('socialite_user')->where('auth_key', $auth_key)->first();
                $img = str_replace('data:image/png;base64,', '', $profile_pic);
                $filename = substr(time(), 0, 15).str_random(30);
                $success= file_put_contents('../reb/img/fans/profile_pic/'.$filename.'.jpg', base64_decode($img));
                $img1 = str_replace('data:image/png;base64,', '', $cover_pic);
                $filename1 = substr(time(), 0, 15).str_random(30);
                $success1= file_put_contents('../reb/img/fans/cover_pic/'.$filename1.'.jpg', base64_decode($img1));
                DB::table('enthusiastic_user')->where('id', $UserData->id)->update(['first_name' => $first_name]);
                DB::table('socialite_user')->where('id', $UserData->id)->update(['profile_pic' => $filename.'.jpg','cover_pic' => $filename1.'.jpg']);
                return Response::json(array('msg' => "updated"), 200); 
            } else {
                return Response::json(array('status' => "Failed", "msg" => "Sorry something went wrong n"), 200);                 
            } 
        }
    }
    //Gleams  updarepersonalInfo ends here 

    //Gleams  searchApi starts here
    public static function searchApi($input) {
        $validation = Validator::make($input, Users::$searchapiRule);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $search_term=$input['search_term'];
            $search_type=$input['search_type'];
            $user_id=$input['user_id'];
            $follow_resultCount = DB::table('follow_table')->where('id', $user_id)->count();
            if($follow_resultCount>0){
                $follow_result = DB::table('follow_table')->where('id', $user_id)->first();
                $follow_final=$follow_result->follow;
                $follow_search=explode(',',$follow_final);
            } else { $follow_search = array(); }             
             if($search_type=='all') {
                $search_result=array();
                $searchData = DB::select("SELECT s.id,s.`profile_pic`,s.user_name,s.auth_key,s.user_type,s.cover_pic FROM `socialite_user` s LEFT JOIN `follow_table` f ON s.id = f.id WHERE s.`user_name` LIKE '".$search_term."%' AND s.`id`!=".$user_id." ORDER BY s.user_name ASC");
                /*DB::table('socialite_user')
                    ->join('follow_table', 'socialite_user.id', '=', 'follow_table.id')
                    ->select('socialite_user.*', 'follow_table.*')->where('socialite_user.user_name','LIKE',$search_term.'%')->where('socialite_user.id','!=',$user_id)
                    ->get(); */
                    foreach($searchData as $searchDatares){
                        $ProfileImageUrl = strpos($searchDatares->profile_pic, 'https://');
                        $CoverImageUrl = strpos($searchDatares->cover_pic, 'https://');
                        if (in_array($searchDatares->id, $follow_search)){
                            $follow=1;
                        } else{
                            $follow=0;
                        }
                        if ($ProfileImageUrl !== false) {
                            $ProfileUrl=$searchDatares->profile_pic; 
                        } else {
                            $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$searchDatares->profile_pic;
                        }
                        if ($CoverImageUrl !== false) {
                            $CoverUrl=$searchDatares->cover_pic; 
                        } else {
                            $CoverUrl='http://gleamedm.com/reb/img/fans/cover_pic/'.$searchDatares->cover_pic;
                        }
                        $search_result[]=array('id'=>$searchDatares->id,'profile_pic'=>$ProfileUrl,'cover_pic'=>$CoverUrl,'user_name'=>$searchDatares->user_name,'auth_key'=>$searchDatares->auth_key,'user_type'=>$searchDatares->user_type,'following'=>$follow);
                    }
                return Response::json(array('status' => 'Success', "msg" => 'search result', 'search_result' => $search_result), 200);
             } elseif ($search_type =='artist'){
                $search_result=array();
                $searchData = DB::select("SELECT s.id,s.`profile_pic`,s.`cover_pic`,s.user_name,s.auth_key,s.user_type FROM `socialite_user` s LEFT JOIN `follow_table` f ON s.id = f.id WHERE s.`user_name` LIKE '".$search_term."%' AND s.`user_type`='artist' ORDER BY s.user_name ASC");
                foreach($searchData as $searchDatares){
                    $followers=DB::select("SELECT * FROM follow_table WHERE follow RLIKE  '[[:<:]]".$searchDatares->id."[[:>:]]'"); 
                    $userFetch = DB::table('artist_user')->where('id', $searchDatares->id)->first();
                    $ProfileImageUrl = strpos($searchDatares->profile_pic, 'https://');
                    $CoverImageUrl = strpos($searchDatares->cover_pic, 'https://');
                    if (in_array($searchDatares->id, $follow_search)){
                        $follow=1;
                    } else{
                        $follow=0;
                    }
                    if ($ProfileImageUrl !== false) {
                            $ProfileUrl=$searchDatares->profile_pic; 
                    } else {
                        $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$searchDatares->profile_pic;
                    }
                    if ($CoverImageUrl !== false) {
                            $CoverUrl=$searchDatares->cover_pic; 
                    } else {
                        $CoverUrl='http://gleamedm.com/reb/img/fans/cover_pic_pic/'.$searchDatares->cover_pic;
                    }
                    $search_result[]=array('id'=>$searchDatares->id,'profile_pic'=>$ProfileUrl,'cover_pic'=>$CoverUrl,'user_name'=>$searchDatares->user_name,'auth_key'=>$searchDatares->auth_key,'user_type'=>$searchDatares->user_type,'full_name'=>$userFetch->first_name,'soundcloud_url'=>$userFetch->soundcloud_url,'following'=>$follow,'followers_count'=>count($followers));
                }
                return Response::json(array('status' => 'Success', "msg" => 'search result', 'search_result' => $search_result), 200);

             } elseif ($search_type =='venue'){
                $search_result=array();
                $searchData = DB::select("SELECT s.id,s.`profile_pic`,s.`cover_pic`,s.user_name,s.auth_key,s.user_type,f.address,f.phone,f.venue_name FROM `socialite_user` s LEFT JOIN `venue_user` f ON s.id = f.id WHERE s.`user_name` LIKE '".$search_term."%' AND s.`user_type`='venue' ORDER BY s.user_name ASC");
                foreach($searchData as $searchDatares){
                        $followers=DB::select("SELECT * FROM follow_table WHERE follow RLIKE  '[[:<:]]".$searchDatares->id."[[:>:]]'");
                        $ProfileImageUrl = strpos($searchDatares->profile_pic, 'https://');
                        $CoverImageUrl = strpos($searchDatares->cover_pic, 'https://');
                        if (in_array($searchDatares->id, $follow_search)){
                            $follow=1;
                        } else{
                            $follow=0;
                        }
                        if ($ProfileImageUrl !== false) {
                            $ProfileUrl=$searchDatares->profile_pic; 
                        } else {
                            $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$searchDatares->profile_pic;
                        }
                        if ($CoverImageUrl !== false) {
                            $CoverUrl=$searchDatares->cover_pic; 
                        } else {
                            $CoverUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$searchDatares->cover_pic;
                        }
                        $search_result[]=array('id'=>$searchDatares->id,'profile_pic'=>$ProfileUrl,'cover_pic'=>$CoverUrl,'user_name'=>$searchDatares->user_name,'auth_key'=>$searchDatares->auth_key,'user_type'=>$searchDatares->user_type,'full_name'=>$searchDatares->venue_name,'adress'=>$searchDatares->address,'phone'=>$searchDatares->phone,'following'=>$follow,'followers_count'=>count($followers));
                    }
                    return Response::json(array('status' => 'Success', "msg" => 'search result', 'search_result' => $search_result), 200);

             }elseif ($search_type =='event'){
                $search_result=array();
                $searchData = DB::select("SELECT s.id,s.`profile_pic`,s.`cover_pic`,s.user_name,s.auth_key,s.user_type,f.address,f.event_name FROM `socialite_user` s LEFT JOIN `event_user` f ON s.id = f.id WHERE s.`user_name` LIKE '".$search_term."%' AND s.`user_type`='event' ORDER BY s.user_name ASC");
                foreach($searchData as $searchDatares){
                        $followers=DB::select("SELECT * FROM follow_table WHERE follow RLIKE  '[[:<:]]".$searchDatares->id."[[:>:]]'"); 
                        $ProfileImageUrl = strpos($searchDatares->profile_pic, 'https://');
                        $CoverImageUrl = strpos($searchDatares->cover_pic, 'https://');
                        if (in_array($searchDatares->id, $follow_search)){
                            $follow=1;
                        } else{
                            $follow=0;
                        }
                        if ($ProfileImageUrl !== false) {
                            $ProfileUrl=$searchDatares->profile_pic; 
                        } else {
                            $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$searchDatares->profile_pic;
                        }
                        if ($CoverImageUrl !== false) {
                            $CoverUrl=$searchDatares->cover_pic; 
                        } else {
                            $CoverUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$searchDatares->cover_pic;
                        }
                        $search_result[]=array('id'=>$searchDatares->id,'profile_pic'=>$ProfileUrl,'cover_pic'=>$CoverUrl,'user_name'=>$searchDatares->user_name,'auth_key'=>$searchDatares->auth_key,'user_type'=>$searchDatares->user_type,'full_name'=>$searchDatares->event_name,'address'=>$searchDatares->address,'following'=>$follow,'followers_count'=>count($followers));
                    }
                    return Response::json(array('status' => 'Success', "msg" => 'search result', 'search_result' => $search_result), 200);

             } else {
                return Response::json(array('status' => 'Error', "msg" => 'Something Went wrong', 'search_result' => array()), 200);
            }
        } 
    }
    //Gleams  searchApi ends here

     //Gleams  newsFeed ends here
    public static function newsFeed($input) {
        $validation = Validator::make($input, Users::$newsFeedRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $authKey=$input['auth_key'];
            $advLike = "0";
            $qc_adv = array();
            $advlikeCountFinal= 0;
            $fullDetails = DB::table('socialite_user')->where('auth_key', $authKey)->first();
            $notCount = DB::table('gleams_notification')->where('receiver', $fullDetails->id)->where('status', 0)->count();
            $followingCount = DB::table('follow_table')->where('follow', 'RLIKE' ,'[[:<:]]'.$fullDetails->id.'[[:>:]]')->count();
            $followcountUser = DB::table('follow_table')->where('id', $fullDetails->id)->count();
            if($followcountUser>0){
                $followcountUserdet = DB::table('follow_table')->where('id', $fullDetails->id)->first();
                $followCountUser=count(explode(',',$followcountUserdet->follow));
            } else{ $followCountUser = 0; }
            $advDetails = DB::table('gleams_adv')->orderBy('adv_id' , 'DESC')->get();
            foreach($advDetails as $advDetails){
                $advlikeCount = DB::table('gleams_likes_adv')->where('post_id', $advDetails->adv_id)->count();
                $IsCommentedAdv = DB::table('gleams_comment_adv')->where('message_id', $advDetails->adv_id)->where('user_id', $fullDetails->id)->count();
                if($IsCommentedAdv>0){ $IcommentedAdv="1"; }else { $IcommentedAdv="0"; }
                if($advlikeCount>0){
                    $advlikeCount = DB::table('gleams_likes_adv')->where('post_id', $advDetails->adv_id)->first();
                    $advCount=$advlikeCount->post_likes;
                    $advlikeCountFinalarray=explode(',',$advCount);
                    $advlikeCountFinal=count($advlikeCountFinalarray);
                    if (in_array($fullDetails->id, $advlikeCountFinalarray)) { $adviLike="1"; } else{ $adviLike="0"; }

                }
                $commentcountADvc = DB::table('gleams_comment_adv')->where('message_id', $advDetails->adv_id)->count();
                if($commentcountADvc>0){
                    $commentcountADv = DB::table('gleams_comment_adv')->where('message_id', $advDetails->adv_id)->get();
                    foreach($commentcountADv as $commentcountADvdet){
                        if(!empty($commentcountADvdet->user_id)){
                            $sql_profile_comment_adv = DB::table('socialite_user')->where('id', $commentcountADvdet->user_id)->first();
                            $ProfileImageUrl = strpos($sql_profile_comment_adv->profile_pic, 'https://');
                            if ($ProfileImageUrl !== false) {
                                $ProfileUrl=$sql_profile_comment_adv->profile_pic; 
                            } else {
                                $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$sql_profile_comment_adv->profile_pic;
                            }
                            $qc_adv[]=array('comment_id' => $commentcountADvdet->comment_id,'message_id' => $commentcountADvdet->message_id,'user_id' => $commentcountADvdet->user_id,'user_email' => $sql_profile_comment_adv->user_email,'user_name' => $sql_profile_comment_adv->user_name,'profile_pic' => $ProfileUrl,'auth_key' => $sql_profile_comment_adv->auth_key,'comment' => $commentcountADvdet->comment);
                        }
                    }
                }
                $url = $advDetails->site_url;
                if($url=="0"){
                    $SiteData=array();                                          
                } else{                    
                    $AdvSiteDatacount = DB::table('glemas_adv_site')->where('ID', $advDetails->adv_id)->count();
                    if($AdvSiteDatacount>0){
                        $SiteData = DB::table('glemas_adv_site')->where('ID', $advDetails->adv_id)->first();
                    } else {
                        $SiteData=array();
                    }                               
                }
                if(!empty($advDetails->adv_img_url)){
                    $post_image_adv=$advDetails->adv_img_url;
                    //list($width_adv, $height_adv) = getimagesize($post_image_adv);
                    $width_adv="0";
                    $height_adv="0";
                } else {
                    $width_adv="0";
                    $height_adv="0";
                }           
                $adv_data[]=array('adv_id'=>$advDetails->adv_id,'user_name'=>$advDetails->adv_name,'name'=>$advDetails->adv_name,'profile_pic'=>$advDetails->adv_img_url,'site_url'=>$advDetails->site_url,'site_data'=>$SiteData,'time_stamp'=>$advDetails->time_stamp,'message'=>$advDetails->adv_des,'image_url'=>$advDetails->adv_img_url,'im_width'=>$width_adv,'im_height'=>$height_adv,'i_comment'=>$IcommentedAdv,'i_like'=>$adviLike,'like_count'=>$advlikeCountFinal,'comments'=>$qc_adv,'comments_count'=>$commentcountADvc,'liked_user' =>$advlikeCountFinalarray);               
            }
            $user_type = $fullDetails->user_type;
            if($user_type!="enthusiastic"){ $url="http://m.ticketmaster.com/ticket/search.do?articles=tmus&query=Drew+Holcomb+and+the+Neighbors"; }
            else{ $url=" "; }
            $user_id = $fullDetails->id;
            $ProfileImageUrl = strpos($fullDetails->profile_pic, 'https://');
            if ($ProfileImageUrl !== false) {
                $profile_pic=$fullDetails->profile_pic; 
            } else {
                $profile_pic='http://gleamedm.com/reb/img/fans/profile_pic/'.$fullDetails->profile_pic;
            }
            $user_full_fetch_follow = DB::table('follow_table')->where('ID', $user_id)->count();
            if($user_full_fetch_follow>0){
                $userfollowResult = DB::table('follow_table')->where('ID', $user_id)->first();
                $follow_value=$userfollowResult->follow;
                $followvalueArray=explode(',',$follow_value);
                $count=count($followvalueArray);
                array_push($followvalueArray, $user_id);
                $followvalueArray=array_reverse($followvalueArray);
            } else {
                $count=0;
                $follow_value=$user_id;
                $followvalueArray=explode(',',$follow_value);
            }
            foreach ($followvalueArray as &$value) {
                    $usedData=DB::table('socialite_user')->where('id', $value)->first();
                    $UserDataType = $usedData->user_type;
                    if($UserDataType=="enthusiastic")
                    {
                        $myq=DB::table('enthusiastic_user')->select('first_name')->where('id', $usedData->id)->first();
                        $name = $myq->first_name;
                        
                    }
                    if($UserDataType=="event")
                    {
                        $myq=DB::table('event_user')->select('event_name')->where('id', $usedData->id)->first();
                        $name = $myq->event_name;
                        
                    }
                    if($UserDataType=="venue")
                    {
                        $myq=DB::table('venue_user')->select('venue_name')->where('id', $usedData->id)->first();
                        $name = $myq->venue_name;
                        
                    }
                    if($UserDataType=="artist")
                    {
                        $myq=DB::table('artist_user')->select('first_name')->where('id', $usedData->id)->first();
                        $name = $myq->first_name;
                        
                    }                    
                    $usersPostcount=DB::table('gleams_post')->where('user_id', $value)->count();
                    if($usersPostcount>0){
                        $usersPostdata=DB::table('gleams_post')->where('user_id', $value)->orderBy('post_id' , 'DESC')->get();
                        foreach($usersPostdata as $usersPostdata){
                            $PostLinksData=DB::table('postlinks')->select('start_loc','end_loc','link')->where('post_id', $usersPostdata->post_id)->get();
                            if(count($PostLinksData)==0){
                                $PostLinksData=array();
                            }
                            if(!empty($usersPostdata->user_id)){                                
                                $user_post_data=DB::table('socialite_user')->where('id', $usersPostdata->user_id)->first();                            
                                $IsCommented=DB::table('gleams_comment')->where('message_id', $usersPostdata->post_id)->where('user_id', $fullDetails->id)->count();
                                if($IsCommented>0){
                                    $Icommented="1";
                                }else {
                                    $Icommented="0";
                                }
                            }                            
                            $postLikeCount=DB::table('gleams_likes')->where('post_id', $usersPostdata->post_id)->count();
                            if($postLikeCount>0){
                                $postLikeCount=DB::table('gleams_likes')->where('post_id', $usersPostdata->post_id)->first();   
                                $likers=explode(",",$postLikeCount->post_likes);
                                $like_count=count($likers);                     
                                if (in_array($fullDetails->id, $likers)) { $i_like=1; } else{ $i_like=0; }
                            } else {
                                $likers=array();
                                $like_count=0;
                                $i_like=0;                                                                  
                            }
                            $comment_count=DB::table('gleams_comment')->where('message_id', $usersPostdata->post_id)->count();
                            $TaggedUsers=DB::table('tagged_user')->where('post_id', $usersPostdata->post_id)->count();
                            if($TaggedUsers > 0){
                                $TaggedUserArray=DB::table('tagged_user')->where('post_id', $usersPostdata->post_id)->get();
                                foreach($TaggedUserArray as $TaggedUserArray){
                                    if($TaggedUserArray->user_type=='artist'){                                        
                                        $soundcloudUrl=DB::table('artist_user')->select('soundcloud_url')->where('id', $TaggedUserArray->user_id)->first();
                                        $TaggedUserArray->sound_cloud=$soundcloudUrl->soundcloud_url;
                                    }
                                    $TaggedUserResult[] = $TaggedUserArray;
                                }
                            } else { $TaggedUserResult=array(); }
                            if(!empty($usersPostdata->image_url)){
                                //$post_image="http://gleamedm.com/reb/img/post/".$v['image_url'];
                                //list($width, $height) = getimagesize($post_image);
                                $width="0";
                                $height="0";
                            } else {
                                $post_image=$usersPostdata->image_url;
                                $width="0";
                                $height="0";
                            }
                            $ProfileImageUrl = strpos($user_post_data->profile_pic, 'https://');
                            if ($ProfileImageUrl !== false) {
                                $ProfileUrl=$user_post_data->profile_pic; 
                            } else {
                                $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$user_post_data->profile_pic;
                            }
                            $qb[] =array('user_id' => $usersPostdata->user_id,'user_email' => $user_post_data->user_email,'user_type' => $user_post_data->user_type,'user_name' => $user_post_data->user_name,'name' => $name,'auth_key' => $user_post_data->auth_key,'profile_pic' => $ProfileUrl,'post_id' => $usersPostdata->post_id,'message' => $usersPostdata->message,'post_links'=>$PostLinksData,'image_url' => $post_image,'im_width' => $width,'im_height' => $height,'tagged_users'=>$TaggedUserResult,'time_stamp' => $usersPostdata->time_stamp,'i_comment'=>$Icommented,'like_count' => $like_count,'i_like' => $i_like,'comments_count' =>$comment_count);

                        }
                    }
                }
                //if(count($qa)==0){ $qa=array(); }
                if(empty($qb)){ $qb=array(); }                
                $user_data = DB::table($user_type.'_user')->where('id', $fullDetails->id)->first();        
                $about=$user_data->about;
                if($user_type=="enthusiastic" OR $user_type=="host" OR $user_type=="artist") { $name=$user_data->first_name; }
                else{
                    $er=$user_type."_name";
                    $name=$user_data->$er;
                }
                foreach ($qb as $key => $node) {
                    $timestamps[$key]    = $node['time_stamp'];
                }
                array_multisort($timestamps, SORT_DESC, $qb);
                if(count($adv_data)==0){ $adv_data=array(); }   
                $success = array( "msg" => "User exist",'id' => $fullDetails->id,'user_type' => $user_type,'notification_count'=>$notCount,'user_name' => $fullDetails->user_name,'name' => $name,'profile_pic' => $profile_pic,'cover_pic' => $fullDetails->cover_pic,'url'=>$url,'about' => $about,'follow_count' => $followCountUser,'following_count' =>$followingCount,'auth_key' => $fullDetails->auth_key,'adv_details'=>$adv_data,'posts'=>$qb);                    
                return Response::json($success, 200);  
        }
            
    }

    //Gleams  newsFeed ends here

    //Gleams  profileView ends here
    public static function profileView($input) {
        $validation = Validator::make($input, Users::$newsFeedRules);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $authKey=$input['auth_key'];
            $advLike = "0";
            $qc_adv = array();
            $advlikeCountFinal= 0;
            $invidualId=$input['user_id'];
            $fullDetails = DB::table('socialite_user')->where('auth_key', $authKey)->first();
            $notCount = DB::table('gleams_notification')->where('receiver', $fullDetails->id)->where('status', 0)->count();
            $followingCount = DB::table('follow_table')->where('follow', 'RLIKE' ,'[[:<:]]'.$fullDetails->id.'[[:>:]]')->count();
            $followcountUser = DB::table('follow_table')->where('id', $fullDetails->id)->count();
            if($followcountUser>0){
                $followcountUserdet = DB::table('follow_table')->where('id', $fullDetails->id)->first();
                $followCountUser=count(explode(',',$followcountUserdet->follow));
            } else{ $followCountUser = 0; }
            $advDetails = DB::table('gleams_adv')->orderBy('adv_id' , 'DESC')->get();
            foreach($advDetails as $advDetails){
                $advlikeCount = DB::table('gleams_likes_adv')->where('post_id', $advDetails->adv_id)->count();
                $IsCommentedAdv = DB::table('gleams_comment_adv')->where('message_id', $advDetails->adv_id)->where('user_id', $invidualId)->count();
                if($IsCommentedAdv>0){ $IcommentedAdv="1"; }else { $IcommentedAdv="0"; }
                if($advlikeCount>0){
                    $advlikeCount = DB::table('gleams_likes_adv')->where('post_id', $advDetails->adv_id)->first();
                    $advCount=$advlikeCount->post_likes;
                    $advlikeCountFinalarray=explode(',',$advCount);
                    $advlikeCountFinal=count($advlikeCountFinalarray);
                    if (in_array($invidualId, $advlikeCountFinalarray)) { $adviLike="1"; } else{ $adviLike="0"; }

                }
                $commentcountADvc = DB::table('gleams_comment_adv')->where('message_id', $advDetails->adv_id)->count();
                if($commentcountADvc>0){
                    $commentcountADv = DB::table('gleams_comment_adv')->where('message_id', $advDetails->adv_id)->get();
                    foreach($commentcountADv as $commentcountADvdet){
                        if(!empty($commentcountADvdet->user_id)){
                            $sql_profile_comment_adv = DB::table('socialite_user')->where('id', $commentcountADvdet->user_id)->first();
                            $ProfileImageUrl = strpos($sql_profile_comment_adv->profile_pic, 'https://');
                            if ($ProfileImageUrl !== false) {
                                $ProfileUrl=$sql_profile_comment_adv->profile_pic; 
                            } else {
                                $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$sql_profile_comment_adv->profile_pic;
                            }
                            $qc_adv[]=array('comment_id' => $commentcountADvdet->comment_id,'message_id' => $commentcountADvdet->message_id,'user_id' => $commentcountADvdet->user_id,'user_email' => $sql_profile_comment_adv->user_email,'user_name' => $sql_profile_comment_adv->user_name,'profile_pic' => $ProfileUrl,'auth_key' => $sql_profile_comment_adv->auth_key,'comment' => $commentcountADvdet->comment);
                        }
                    }
                }
                $url = $advDetails->site_url;
                if($url=="0"){
                    $SiteData=array();                                          
                } else{                    
                    $AdvSiteDatacount = DB::table('glemas_adv_site')->where('ID', $advDetails->adv_id)->count();
                    if($AdvSiteDatacount>0){
                        $SiteData = DB::table('glemas_adv_site')->where('ID', $advDetails->adv_id)->first();
                    } else {
                        $SiteData=array();
                    }                               
                }
                if(!empty($advDetails->adv_img_url)){
                    $post_image_adv=$advDetails->adv_img_url;
                    //list($width_adv, $height_adv) = getimagesize($post_image_adv);
                    $width_adv="0";
                    $height_adv="0";
                } else {
                    $width_adv="0";
                    $height_adv="0";
                }           
                $adv_data[]=array('adv_id'=>$advDetails->adv_id,'user_name'=>$advDetails->adv_name,'name'=>$advDetails->adv_name,'profile_pic'=>$advDetails->adv_img_url,'site_url'=>$advDetails->site_url,'site_data'=>$SiteData,'time_stamp'=>$advDetails->time_stamp,'message'=>$advDetails->adv_des,'image_url'=>$advDetails->adv_img_url,'im_width'=>$width_adv,'im_height'=>$height_adv,'i_comment'=>$IcommentedAdv,'i_like'=>$adviLike,'like_count'=>$advlikeCountFinal,'comments'=>$qc_adv,'comments_count'=>$commentcountADvc,'liked_user' =>$advlikeCountFinalarray);               
            }
            $user_type = $fullDetails->user_type;
            if($user_type!="enthusiastic"){ $url="http://m.ticketmaster.com/ticket/search.do?articles=tmus&query=Drew+Holcomb+and+the+Neighbors"; }
            else{ $url=" "; }
            $user_id = $fullDetails->id;
            $ProfileImageUrl = strpos($fullDetails->profile_pic, 'https://');
            if ($ProfileImageUrl !== false) {
                $profile_pic=$fullDetails->profile_pic; 
            } else {
                $profile_pic='http://gleamedm.com/reb/img/fans/profile_pic/'.$fullDetails->profile_pic;
            }
            $user_full_fetch_follow = DB::table('follow_table')->where('ID', $user_id)->count();
            $follow_value=$user_id;
            $followvalueArray=explode(',',$follow_value);
            foreach ($followvalueArray as &$value) {
                    $usedData=DB::table('socialite_user')->where('id', $value)->first();
                    $UserDataType = $usedData->user_type;
                    if($UserDataType=="enthusiastic")
                    {
                        $myq=DB::table('enthusiastic_user')->select('first_name')->where('id', $usedData->id)->first();
                        $name = $myq->first_name;
                        
                    }
                    if($UserDataType=="event")
                    {
                        $myq=DB::table('event_user')->select('event_name')->where('id', $usedData->id)->first();
                        $name = $myq->event_name;
                        
                    }
                    if($UserDataType=="venue")
                    {
                        $myq=DB::table('venue_user')->select('venue_name')->where('id', $usedData->id)->first();
                        $name = $myq->venue_name;
                        
                    }
                    if($UserDataType=="artist")
                    {
                        $myq=DB::table('artist_user')->select('first_name')->where('id', $usedData->id)->first();
                        $name = $myq->first_name;
                        
                    }                    
                    $usersPostcount=DB::table('gleams_post')->where('user_id', $value)->count();
                    if($usersPostcount>0){
                        $usersPostdata=DB::table('gleams_post')->where('user_id', $value)->orderBy('post_id' , 'DESC')->get();
                        foreach($usersPostdata as $usersPostdata){
                            $PostLinksData=DB::table('postlinks')->select('start_loc','end_loc','link')->where('post_id', $usersPostdata->post_id)->get();
                            if(count($PostLinksData)==0){
                                $PostLinksData=array();
                            }
                            if(!empty($usersPostdata->user_id)){                                
                                $user_post_data=DB::table('socialite_user')->where('id', $usersPostdata->user_id)->first();                            
                                $IsCommented=DB::table('gleams_comment')->where('message_id', $usersPostdata->post_id)->where('user_id', $invidualId)->count();
                                if($IsCommented>0){
                                    $Icommented="1";
                                }else {
                                    $Icommented="0";
                                }
                            }                            
                            $postLikeCount=DB::table('gleams_likes')->where('post_id', $usersPostdata->post_id)->count();
                            if($postLikeCount>0){
                                $postLikeCount=DB::table('gleams_likes')->where('post_id', $usersPostdata->post_id)->first();   
                                $likers=explode(",",$postLikeCount->post_likes);
                                $like_count=count($likers);                     
                                if (in_array($invidualId, $likers)) { $i_like=1; } else{ $i_like=0; }
                            } else {
                                $likers=array();
                                $like_count=0;
                                $i_like=0;                                                                  
                            }
                            $comment_count=DB::table('gleams_comment')->where('message_id', $usersPostdata->post_id)->count();
                            $TaggedUsers=DB::table('tagged_user')->where('post_id', $usersPostdata->post_id)->count();
                            if($TaggedUsers > 0){
                                $TaggedUserArray=DB::table('tagged_user')->where('post_id', $usersPostdata->post_id)->get();
                                foreach($TaggedUserArray as $TaggedUserArray){
                                    if($TaggedUserArray->user_type=='artist'){                                        
                                        $soundcloudUrl=DB::table('artist_user')->select('soundcloud_url')->where('id', $TaggedUserArray->user_id)->first();
                                        $TaggedUserArray->sound_cloud=$soundcloudUrl->soundcloud_url;
                                    }
                                    $TaggedUserResult[] = $TaggedUserArray;
                                }
                            } else { $TaggedUserResult=array(); }
                            if(!empty($usersPostdata->image_url)){
                                //$post_image="http://gleamedm.com/reb/img/post/".$v['image_url'];
                                //list($width, $height) = getimagesize($post_image);
                                $width="0";
                                $height="0";
                            } else {
                                $post_image=$usersPostdata->image_url;
                                $width="0";
                                $height="0";
                            }
                            $ProfileImageUrl = strpos($user_post_data->profile_pic, 'https://');
                            if ($ProfileImageUrl !== false) {
                                $ProfileUrl=$user_post_data->profile_pic; 
                            } else {
                                $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$user_post_data->profile_pic;
                            }
                            $qb[] =array('user_id' => $usersPostdata->user_id,'user_email' => $user_post_data->user_email,'user_type' => $user_post_data->user_type,'user_name' => $user_post_data->user_name,'name' => $name,'auth_key' => $user_post_data->auth_key,'profile_pic' => $ProfileUrl,'post_id' => $usersPostdata->post_id,'message' => $usersPostdata->message,'post_links'=>$PostLinksData,'image_url' => $post_image,'im_width' => $width,'im_height' => $height,'tagged_users'=>$TaggedUserResult,'time_stamp' => $usersPostdata->time_stamp,'i_comment'=>$Icommented,'like_count' => $like_count,'i_like' => $i_like,'comments_count' =>$comment_count);

                        }
                    }
                }
                //if(count($qa)==0){ $qa=array(); }
                if(empty($qb)){ $qb=array(); }                
                $user_data = DB::table($user_type.'_user')->where('id', $fullDetails->id)->first();        
                $about=$user_data->about;
                if($user_type=="enthusiastic" OR $user_type=="host" OR $user_type=="artist") { $name=$user_data->first_name; }
                else{
                    $er=$user_type."_name";
                    $name=$user_data->$er;
                }
                foreach ($qb as $key => $node) {
                    $timestamps[$key]    = $node['time_stamp'];
                }
                array_multisort($timestamps, SORT_DESC, $qb);
                if(count($adv_data)==0){ $adv_data=array(); }   
                $success = array( "msg" => "User exist",'id' => $fullDetails->id,'user_type' => $user_type,'notification_count'=>$notCount,'user_name' => $fullDetails->user_name,'name' => $name,'profile_pic' => $profile_pic,'cover_pic' => $fullDetails->cover_pic,'url'=>$url,'about' => $about,'follow_count' => $followCountUser,'following_count' =>$followingCount,'auth_key' => $fullDetails->auth_key,'adv_details'=>$adv_data,'posts'=>$qb);                    
                return Response::json($success, 200);  
        }
            
    }

    //Gleams  profileView ends here


    //Gleams  commentList ends here
    public static function commentList($input) {
        $validation = Validator::make($input, Users::$commentlistRule);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId=$input['user_id'];
            $postId=$input['post_id'];
            $TaggedUserResult=array();
            $PostLinksData=DB::table('postlinks')->select('start_loc','end_loc','link')->where('post_id', $postId)->get();
            $TaggedUsersCount=DB::table('tagged_user')->where('post_id', $postId)->count();
            if($TaggedUsersCount>0){
                $TaggedUserArray=DB::table('tagged_user')->where('post_id', $postId)->get();
                foreach($TaggedUserArray as $TaggedUserArray){
                    if($TaggedUserArray->user_type=='artist'){                                        
                        $soundcloudUrl=DB::table('artist_user')->select('soundcloud_url')->where('id', $TaggedUserArray->user_id)->first();
                        $TaggedUserArray->sound_cloud=$soundcloudUrl->soundcloud_url;
                    }
                    $TaggedUserResult[] = $TaggedUserArray;
                }
            }
            $FinalLinks=array("post_links"=>$PostLinksData,"tagged_users"=>$TaggedUserResult);
            $PostLikeP=DB::table('gleams_likes')->where('post_id', $postId)->count();        
            $IsCommented=DB::table('gleams_comment')->where('message_id', $postId)->where('user_id', $userId)->count();
            if($IsCommented>0){
                $Icommented=array('i_comment'=>"1");
            }else {
                $Icommented=array('i_comment'=>"0");
            }
            if($PostLikeP>0){
                $PostLikeData=DB::table('gleams_likes')->where('post_id', $postId)->first();
                $PostLikeArray=explode(",",$PostLikeData->post_likes);
                $PostLikeCount=count($PostLikeArray);
                if (in_array($userId,$PostLikeArray )) {
                    $like=1;
                }
                else {
                    $like=0;
                }
            } else {
                $PostLikeCount=0;
                $like=0;
            }

            $user_data=DB::table('gleams_post')
                    ->join('socialite_user', 'gleams_post.user_id', '=', 'socialite_user.id')
                    ->select('gleams_post.post_id', 'gleams_post.user_id','gleams_post.message','gleams_post.image_url', 'gleams_post.time_stamp','socialite_user.id', 'socialite_user.user_name', 'socialite_user.auth_key', 'socialite_user.profile_pic', 'socialite_user.cover_pic')->where('gleams_post.post_id',$postId)
                    ->get();
            if(empty($user_data->image_url)){
                $ImageWH=array('im_width'=>'0','im_height'=>'0');
            } else {
                $post_image="http://gleamedm.com/reb/img/post/".$user_data->image_url;
                list($width, $height) = getimagesize($post_image);
                $ImageWH=array('im_width'=>$width,'im_height'=>$height);    
            }
            $CommentData=DB::select("SELECT o.id, o.user_name, o.auth_key, o.profile_pic, o.cover_pic, c.comment_id, c.message_id, c.user_id, c.comment FROM gleams_comment c LEFT JOIN socialite_user o ON c.user_id = o.id WHERE c.message_id =".$postId."");
            //$CommentData=mysql_fetch_assoc($Comments);
            $CommentCount=array('commentcount'=>count($CommentData));
            $PostLikeCounts=array('likecount'=>$PostLikeCount);
            $Like=array('like'=>$like);
            $CommentData = array_filter($CommentData);
            //$CommentData=end($CommentData);
            $Result = array_merge($user_data,$ImageWH,$CommentCount,$PostLikeCounts,$Like,$Icommented,$FinalLinks);
            $success = array('postdata' => $Result[0],'commentdata' => $CommentData);
            return Response::json($success, 200);  

        }
    }
    //Gleams  commentList ends here

    //Gleams  adv_comment_list ends here
    public static function advcommentList($input) {
        $validation = Validator::make($input, Users::$advcommentlistRule);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId=$input['user_id'];
            $postId=$input['post_id'];
            $TaggedUserResult=array();
            $PostLikeP=DB::table('gleams_likes_adv')->where('post_id', $postId)->count();        
            $IsCommented=DB::table('gleams_comment_adv')->where('message_id', $postId)->where('user_id', $userId)->count();
            if($IsCommented>0){
                $Icommented=array('i_comment'=>"1");
            }else {
                $Icommented=array('i_comment'=>"0");
            }
            if($PostLikeP>0){
                $PostLikeData=DB::table('gleams_likes_adv')->where('post_id', $postId)->first();
                $PostLikeArray=explode(",",$PostLikeData->post_likes);
                $PostLikeCount=count($PostLikeArray);
                if (in_array($userId,$PostLikeArray )) {
                    $like=1;
                }
                else {
                    $like=0;
                }
            } else {
                $PostLikeCount=0;
                $like=0;
            }
            $user_data=DB::table('gleams_adv')->where('adv_id', $postId)->first();
            $UserData=array('id'=>'ADV','user_name'=>$user_data->adv_name,'auth_key'=>'12345678','profile_pic'=>$user_data->adv_img_url,'cover_pic'=>$user_data->adv_img_url,'post_id'=>$user_data->adv_id,'user_id'=>'ADV','message'=>$user_data->adv_des,'image_url'=>$user_data->adv_img_url,'time_stamp'=>$user_data->time_stamp);            
            $CommentData=DB::select("SELECT o.id, o.user_name, o.auth_key, o.profile_pic, o.cover_pic, c.comment_id, c.message_id, c.user_id, c.comment FROM gleams_comment_adv c LEFT JOIN socialite_user o ON c.user_id = o.id WHERE c.message_id =".$postId."");
             $CommentCount=array('commentcount'=>count($CommentData));
            $PostLikeCounts=array('likecount'=>$PostLikeCount);
            $Like=array('like'=>$like);
            $CommentData = array_filter($CommentData);
            $Result = array_merge($UserData,$CommentCount,$PostLikeCounts,$Like,$Icommented);
            $success = array('postdata' => $Result,'commentdata' => $CommentData);
            return Response::json($success, 200);  

        }
    }
    //Gleams  adv_comment_list ends here

    //Gleams  gleamsPost ends here
    public static function gleamsPost($input) {
        $validation = Validator::make($input, Users::$gleamsPostRule);
        if($validation->fails()) {
            return Response::json(array('status' => "Error", 'msg'=>$validation->getMessageBag()->first()), 200);
        } else {
            $userId = $input['user_id']; 
            $message = $input['message']; 
            $img = $input['img']; 
            $TaggedUser=$input['tagged_users'];
            $PostLink=$input['postlinks'];
            if(empty($img)){
                $InsertedId = DB::table('gleams_post')->insertGetId(
                    array(
                        'user_id' => $userId,
                        'message' => $message,
                        'image_url' => ''
                    )
                );
                foreach ($PostLink as $NewPostLink)
                {
                    DB::table('postlinks')->insertGetId(
                    array(
                        'post_id' => $InsertedId,
                        'start_loc' => $NewPostLink['start_loc'],
                        'end_loc' => $NewPostLink['end_loc'],
                        'link' => $NewPostLink['link']
                    )
                    );
                }
                foreach ($TaggedUser as $NewTaggedUser)
                {
                    DB::table('tagged_user')->insertGetId(
                    array(
                        'auth_key' => $NewTaggedUser['auth_key'],
                        'user_id' => $NewTaggedUser['user_id'],
                        'user_type' => $NewTaggedUser['user_type'],
                        'user_name' => $NewTaggedUser['user_name'],
                        'start_loc' => $NewTaggedUser['start_loc'],
                        'end_loc' => $NewTaggedUser['end_loc'],
                        'post_id' => $InsertedId
                    )
                    );
                    $SenderDetails = DB::table('socialite_user')->where('id', $userId)->first();
                    $ReceiverDetails = DB::table('socialite_user')->select('device_token')->where('id', $NewTaggedUser['user_id'])->first();   
                    $ProfileImageUrl = strpos($SenderDetails->profile_pic, 'https://');
                    if ($ProfileImageUrl !== false) {
                        $ProfileUrl=$SenderDetails->profile_pic; 
                    } else {
                        $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$SenderDetails->profile_pic;
                    }
                    if($ReceiverDetails->device_token !=' '){
                        Users::PushNotification($userId,$SenderDetails->auth_key,$SenderDetails->user_name,'tagging',$InsertedId,$ReceiverDetails->device_token,$ProfileUrl);
                    } 
                    //PushNotificatio($json['user_id'],$SenderDetails['auth_key'],$SenderDetails['user_name'],'tagging',$InsertedId,$ReceiverDetails['device_token'],$ProfileUrl);
                    DB::table('gleams_notification')->insertGetId(
                    array(
                        'sender' => $userId,
                        'receiver' => $SenderDetails->id,
                        'notifier_type' => 'post',
                        'message' => $message,
                        'post_id' => $InsertedId,
                        'status' => 0
                    )
                    );
                }
                $success = array('status' => 'Success');
                return Response::json($success, 200); 
            } else{
                $imgNew = str_replace('data:image/png;base64,', '', $img);
                $filename = substr(time(), 0, 15).str_random(30);
                $success= file_put_contents('../reb/img/post/'.$filename.'.jpg', base64_decode($imgNew));
                    if($success){                       
                         $InsertedId = DB::table('gleams_post')->insertGetId(
                            array(
                            'user_id' => $userId,
                            'message' => $message,
                            'image_url' => $filename.'.jpg'
                            )
                        );
                        foreach ($PostLink as $NewPostLink){
                            DB::table('postlinks')->insertGetId(
                            array(
                                'post_id' => $InsertedId,
                                'start_loc' => $NewPostLink['start_loc'],
                                'end_loc' => $NewPostLink['end_loc'],
                                'link' => $NewPostLink['link']
                            )
                            );
                        }
                        foreach ($TaggedUser as $NewTaggedUser){
                            DB::table('tagged_user')->insertGetId(
                            array(
                                'auth_key' => $NewTaggedUser['auth_key'],
                                'user_id' => $NewTaggedUser['user_id'],
                                'user_type' => $NewTaggedUser['user_type'],
                                'user_name' => $NewTaggedUser['user_name'],
                                'start_loc' => $NewTaggedUser['start_loc'],
                                'end_loc' => $NewTaggedUser['end_loc'],
                                'post_id' => $InsertedId
                            )
                            );
                            $SenderDetails = DB::table('socialite_user')->where('id', $userId)->first();
                            $ReceiverDetails = DB::table('socialite_user')->select('device_token')->where('id', $NewTaggedUser['user_id'])->first();   
                            $ProfileImageUrl = strpos($SenderDetails->profile_pic, 'https://');
                            if ($ProfileImageUrl !== false) {
                                $ProfileUrl=$SenderDetails->profile_pic; 
                            } else {
                                $ProfileUrl='http://gleamedm.com/reb/img/fans/profile_pic/'.$SenderDetails->profile_pic;
                            }
                            if($ReceiverDetails->device_token !=' '){
                            Users::PushNotification($userId,$SenderDetails->auth_key,$SenderDetails->user_name,'tagging',$InsertedId,$ReceiverDetails->device_token,$ProfileUrl);
                            }
                            DB::table('gleams_notification')->insertGetId(
                            array(
                                'sender' => $userId,
                                'receiver' => $SenderDetails->id,
                                'notifier_type' => 'post',
                                'message' => $message,
                                'post_id' => $InsertedId,
                                'status' => 0
                            )
                            );
                        }
                        $success = array('status' => 'Success');
                        return Response::json($success, 200);
                    }else{
                    $error = array('status' => "Failed", "msg" => "Sorry something went wrong");
                        return Response::json($error, 200);
                    }
                    $success = array('status' => "fail");               
                    return Response::json($success, 200);
            }
        }
    }
    //Gleams  gleamsPost ends here
    
    // Image Upload Methods
    public static function uploadProfileImage() {
        if(Input::file('profile_pic')->isValid()){
            // store file input in a variable
            $file = Input::file('profile_pic');
            //get extension of file
            $ext = $file->getClientOriginalExtension();
            //directory to store images
            $dir = 'uploads';
            // change filename to random name
            $filename = substr(time(), 0, 15).str_random(30) . ".{$ext}";
            // move uploaded file to temp. directory
            $upload_success = Input::file('profile_pic')->move($dir, $filename);
            $img = $upload_success ? $filename : '';
        }
        return $img;
    }

    public static function uploadCoverImage() {
        if(Input::file('cover_pic')->isValid()){
            // store file input in a variable
            $file = Input::file('cover_pic');
            //get extension of file
            $ext = $file->getClientOriginalExtension();
            //directory to store images
            $dir = 'uploads';
            // change filename to random name
            $filename = substr(time(), 0, 15).str_random(30) . ".{$ext}";
            // move uploaded file to temp. directory
            $upload_success = Input::file('cover_pic')->move($dir, $filename);
            $img = $upload_success ? $filename : '';
        }
        return $img;
    }

}
