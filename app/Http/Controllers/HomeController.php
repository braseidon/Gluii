<?php namespace App\Http\Controllers;

use Auth;
use App\Repositories\ActivityRepositoryInterface;

class HomeController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Show the Home Page
     *
     * @return Response
     */
    public function getIndex(ActivityRepositoryInterface $repository)
    {
        if (! Auth::check()) {
            return view('home.leadpages');
        }

        $activities = $repository->getAllUsersFeeds(['status', 'photo']);
        // dd($activities->items());

        return view('feeds.news', compact('activities'));
    }

    /**
     * Some page
     *
     * @return Response
     */
    public function getHome()
    {
        return view('home');
    }

    /**
     * Test sending an email
     *
     * @return die()
     */
    public function getTestEmail()
    {
        $user = new \App\Models\User;
        $code = '32k4j5325';

        $sent = \Mail::send('emails.auth.activate', compact('user', 'code'), function ($m) use ($user) {
            $m->to('bluejd910@gmail.com')->subject('Activate Your Account');
        });

        dd($sent);
    }
}
