<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;
use GuzzleHttp\Client;

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

    public function notification()
    {
    	$client = new \GuzzleHttp\Client();

		$response = $client->request('POST', 'https://onesignal.com/api/v1/notifications', [
		  'body' => '{"included_segments":["Subscribed Users"],"name":"INTERNAL_CAMPAIGN_NAME"}',
		  'headers' => [
		    'Accept' => 'application/json',
		    'Authorization' => 'Basic MTZhNWZhZmYtMTA1MC00NTQyLWE3MGQtODcwMmE1OTFiYjUw',
		    'Content-Type' => 'application/json',
		  ],
		]);

		echo $response->getBody();	
    }

}
