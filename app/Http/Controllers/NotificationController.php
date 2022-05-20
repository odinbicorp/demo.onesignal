<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ladumor\OneSignal\OneSignal;

class NotificationController extends Controller
{
    public function sendPush()
    {
    	$fields['include_player_ids'] = ['945ed348-3c59-4af9-b369-ceecb898fb68'];
		$message = 'hey!! this is test push.!';
		$mess = OneSignal::sendPush($fields,$message);
		dd($mess);
		$notificationID = OneSignal::sendPush($fields, $message);
		echo "1".$notificationID["id"];
    }

    public function getNotifications()
    {
    	return OneSignal::getNotification($notificationId);     
    }

    public function getNotification ($notificationId)
    {
    	return OneSignal::getNotification($notificationId);    
    }

    public function getDevices()
    {
    	return OneSignal::getDevices();
    }

    public function getDevice($deviceId)
    {
    	return OneSignal::getDevice($deviceId);    
    }

    public function sendMessage()
    {
    	return view('subscribe');
    }

    public function pushMessage(Request $request)
    {
    	$message = $request->message;
        $user_id = $request->user_id;
        $content = array(
            "en" => "$message"
        );

        $fields = array(
            'app_id' => "945ed348-3c59-4af9-b369-ceecb898fb68",
            'filters' => array(array("field" => "tag", "key" => "user_id", "relation" => "=", "value" => "$user_id")),
            'contents' => $content
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic NGM0Mzk5YjMtNTQzMi00OTkwLTkyY2EtMTI1MzNhODBmZjgz'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
       return $response;
    }
}
