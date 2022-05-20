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
}
