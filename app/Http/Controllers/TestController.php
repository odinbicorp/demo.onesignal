<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;


class TestController extends Controller
{
    public function test()
    {
        $fields['include_player_ids'] = ['9ee6bb4c-c352-4077-a8ac-4184c69f53e3'];
        $notificationMsg = 'Hello!! A tiny web push notification.!';
        OneSignal::sendPush($fields, $notificationMsg);
        $allNotification = OneSignal::getNotifications();
        dd($allNotification);
        return view('home');
    }

}
