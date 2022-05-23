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
  //   	$client = new \GuzzleHttp\Client();

		// $response = $client->request('POST', 'https://onesignal.com/api/v1/notifications', [
		//   'body' => '{"included_segments":["Subscribed Users"],"name":"INTERNAL_CAMPAIGN_NAME"}',
		//   'headers' => [
		//     'Accept' => 'application/json',
		//     'Authorization' => 'Basic MTZhNWZhZmYtMTA1MC00NTQyLWE3MGQtODcwMmE1OTFiYjUw',
		//     'Content-Type' => 'application/json',
		//   ],
		// ]);

		// echo $response->getBody();	
		$response = $this->sendMessage();
		 return view('home',compact('response'));
		// $return["allresponses"] = $response;
		// $return = json_encode($return);

		// $data = json_decode($response, true);
		// print_r($data);
		// $id = $data['id'];
		// print_r($id);

		// print("\n\nJSON received:\n");
		// print($return);
		// print("\n");
    }

    public function sendMessage() {
	    $content      = array(
	        "en" => 'English Message'
	    );
	    $hashes_array = array();
	    array_push($hashes_array, array(
	        "id" => "like-button",
	        "text" => "Like",
	        "icon" => "http://i.imgur.com/N8SN8ZS.png",
	        "url" => "https://onesignal.odinbi.app"
	    ));
	    array_push($hashes_array, array(
	        "id" => "like-button-2",
	        "text" => "Like2",
	        "icon" => "http://i.imgur.com/N8SN8ZS.png",
	        "url" => "https://onesignal.odinbi.app"
	    ));
	    $fields = array(
	        'app_id' => "00439ee5-1c4a-4774-806d-81189e86a38d",
	        'included_segments' => array(
	            'Subscribed Users'
	        ),
	        'data' => array(
	            "foo" => "bar"
	        ),
	        'contents' => $content,
	        'web_buttons' => $hashes_array
	    );
	    
	    $fields = json_encode($fields);
	    print("\nJSON sent:\n");
	    print($fields);
	    
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Content-Type: application/json; charset=utf-8',
	        'Authorization: Basic ZGMyOWRiYTMtN2QwOC00NGFmLTkwNDAtOGExNDMxOWE2N2M5'
	    ));
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
