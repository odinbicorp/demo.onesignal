<?php

namespace App\Listeners;

use App\Events\NewPostAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
// use NNV\OneSignal\OneSignal;
// use NNV\OneSignal\API\Notification;
use Illuminate\Support\Facades\Notification;
use Ladumor\OneSignal\OneSignal;
use Log;

class NewPostNotification
{
    private $oneSignal;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->oneSignal = new OneSignal(
        //     env("ONESIGNAL_AUTH_KEY"), env("ONESIGNAL_APP_ID"), env("ONESIGNAL_APP_REST_KEY")
        // );
        $this->oneSignal = new OneSignal(
            env("ONE_SIGNAL_AUTH_KEY"), env("ONE_SIGNAL_APP_ID"), env("ONE_SIGNAL_AUTHORIZE")
        );
    }

    /**
     * Handle the event.
     *
     * @param  NewPostAdded  $event
     * @return void
     */
    public function handle(NewPostAdded $event)
    {
        $oneSingalNotification = new Notification($this->oneSignal);
        $post = $event->post;
        $notificationData = [
            "included_segments" => ["All"],
            "contents" => [
                "en" => $post->description,
            ],
            "headings" => [
                "en" => $post->title,
            ],
            "web_buttons" => [
                [
                    "id" => "readmore-button",
                    "text" => "Read more",
                    "url" => "https://onesignal.odinbi.app/posts/" . $post->id,
                ]
            ],
            "isChromeWeb" => true,
        ];

        // $notification = $oneSingalNotification->create($notificationData);

        // Log::useDailyFiles(storage_path() . "/logs/onesignal.log");
        // Log::info($notification);
    }
}
