## Ionic Push Notification Service

------------

The ionic push notification service work send and manager the push notifications from Ionic Cloud.

### Send a Push Notification

You need have the *uuid* (*User id*) to send a push notification. With the *uuid*, this library send a push notification to all devices where the user is logged.

Parameters of method:

- $title: *string* [**required**];
- $message: *string* [**required**];
- $uuid: *array* [**required**];
- $data: *array* [**optional**] (data that you want send to mobile app);
- $token: *string* [**optional**] (for default, the library use the token configured in "*config/ionic-cloud.php*" file, but if you want, can send the token here);
- $profile: *string* [**optional**] (for default, the library use the certificate profile configured in "*config/ionic-cloud.php*" file, but if you want, can send the certificate profile here);

```php
    $push = new \BrunoCouty\IonicCloud\Services\Push();
    $title = "New Notification!"; // The notification title (string)
    $message = "You have a new notification!"; // The notification message (string)
    $uuid = ["123abc-asd8asdhiasdh0asdhoad0a"]; // An array with the user-ids of the users that will receive the push notification
    $data = [
        'foo' => '1',
        'bar' => '2'
    ]; // Some data that you want send throught push notification (optional)
    $response = $push->send(
                                $title, 
                                $message, 
                                $uuid, 
                                $data // if there's not data, send empty array or delete this parameter
                            ); // If ok, return 200
```

If you want work with more than one app, you need send the authentication data as parameters in *send* method:

```php
$token = 'your-token';
$profile = 'your-profile';
$response = $push->send(
                            $title, 
                            $message, 
                            $uuid, 
                            $data,
                            $token,
                            $profile
                        );
```

----------------

[<– Back to start](../readme.md)