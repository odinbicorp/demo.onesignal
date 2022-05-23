<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script> -->
 <script src="/OneSignalSDKWorker.js" async=""></script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
</head>
<body>

<div class="container">
  <div class="starter-template">
        <h1>OneSignal  Subscription</h1>
        <p class="lead">User Subscribe Page</p>
    </div>

    <div class="contact-form">

        <p class="notice error">TEST</p><br/>

        <form id="ServiceRequest" action="#" method='post'>
          @csrf
            <div class="form-group">
                <label class="control-label">Message Body:</label>
                <input type="text" name="message" class="form-control" placeholder="Add Your Message" value="" >
            </div>
            <div class="form-group">
                <label class="control-label">Message Body:</label>
                <input type="text" name="user_id" class="form-control" readonly value="4444" >
            </div>
            <div id='submit_button'>
                <input class="btn btn-success" type="submit" name="submit" value="Send data"/>
            </div>
        </form>
    </div>

<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
<script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(["init", {
        appId: "00439ee5-1c4a-4774-806d-81189e86a38d",
        subdomainName: 'onesignal',
        autoRegister: true,
        promptOptions: {
            /* These prompt options values configure both the HTTP prompt and the HTTP popup. */
            /* actionMessage limited to 90 characters */
            actionMessage: "We'd like to show you notifications for the latest news.",
            /* acceptButtonText limited to 15 characters */
            acceptButtonText: "ALLOW",
            /* cancelButtonText limited to 15 characters */
            cancelButtonText: "NO THANKS"
        }
    }]);
</script>
<script>
    function subscribe() {
        // OneSignal.push(["registerForPushNotifications"]);
        OneSignal.push(["registerForPushNotifications"]);
        event.preventDefault();
    }
    function unsubscribe(){
        OneSignal.setSubscription(true);
    }

    var OneSignal = OneSignal || [];
    OneSignal.push(function() {
        /* These examples are all valid */
        // Occurs when the user's subscription changes to a new value.
        OneSignal.on('subscriptionChange', function (isSubscribed) {
            console.log("The user's subscription state is now:", isSubscribed);
            OneSignal.sendTag("user_id","4444", function(tagsSent)
            {
                // Callback called when tags have finished sending
                console.log("Tags have finished sending!");
            });
        });

        var isPushSupported = OneSignal.isPushNotificationsSupported();
        if (isPushSupported)
        {
            // Push notifications are supported
            OneSignal.isPushNotificationsEnabled().then(function(isEnabled)
            {
                if (isEnabled)
                {
                    console.log("Push notifications are enabled!");

                } else {
                    OneSignal.showHttpPrompt();
                    console.log("Push notifications are not enabled yet.");
                }
            });

        } else {
            console.log("Push notifications are not supported.");
        }
    });


</script>
</div>

</body>
</html>
