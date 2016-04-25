<?php namespace App\Http\Middleware;



class VerifyCsrf extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken

{

    /**
     * Routes we want to exclude.
     *
     * @var array
     */

    protected $routes = [
        'gleams-signup',

        'gleams_fb_signup',

        'api/sign-up',

        'gleams_logout',

        'gleams_change_password',

        'gleams_follow',

        'gleams_unfollow',

        'gleams_message_send',

        'gleams_get_all_message',

        'gleams_message_status',

        'users_list',

        'follow_list',

        'following_list',

        'mutual_follow',

        'gleams_like',

        'gleams_unlike',

        'gleams_adv_like',

        'gleams_adv_unlike',

        'gleams_gallery',

        'gleams_gallery_show',

        'message_per_person',

        'gleams_commenting',

        'gleams_adv_commenting',

        'gleams_insert_notify',

        'gleams_notification',

        'gleams_notification_status',

        'notification_staus_change',

        'post_like_list',

        'commented_users',

        'commented_adv_users',

        'message_count',

        'update_devicetoken',

        'gleams_user_data',

        'request_vip',

        'nearest_events',

        'gleamsGallery',

        'update_personal_info_gleams_user',

        'forgot_password',

        'adv_post_like_list',

        'login',

        'search',

        'news_feed',

        'profile_view',

        'comment_list',

        'adv_comment_list',

        'post',

        'change-password',

        'forgot-password',

        'api/password-reset-2',

    ];



    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */

    public function handle($request, \Closure $next)

    {

        if ($this->isReading($request)

            || $this->excludedRoutes($request)

            || $this->tokensMatch($request))

        {

            return $this->addCookieToResponse($request, $next($request));

        }



        throw new \TokenMismatchException;

    }



    /**
     * This will return a bool value based on route checking.
     * @param  Request $request
     * @return boolean
     */

    protected function excludedRoutes($request)

    {

        foreach($this->routes as $route)
            if ($request->is($route))
                return true;

        return false;

    }



}