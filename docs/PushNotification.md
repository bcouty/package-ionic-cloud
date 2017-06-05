## Ionic Push Notification Service

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

### Paginated listing of Push Notifications for an App

Method parameters:

- $page_size: *int* [optional] - Number of items to return in paginated resulted (set 0 to no limits);
- $page: *int* [optional] - The page number for paginated (set 1 or nothing to return first page);
- $token: *string* [optional];

```php
    $push = new \BrunoCouty\IonicCloud\Services\Push();
    $response = $push->listNotifications(); // or $push->listNotifications(0, 1, $token);
    return $response;
```

Response status 200:

```php
{  
   "data":[  
      {  
         "uuid":"notification-uuid-(notification-id)",
         "config":{  
            "notification":{  
               "ios":{  
                  "content_available":1,
                  "sound":"default"
               },
               "message":"message-sent",
               "title":"notification-title"
            },
            "tokens":[  
               "token-that-received-notification",
               "token-that-received-notification",
               "token-that-received-notification"
            ],
            "profile":"certificates-profile"
         },
         "created":"2017-05-24T22:53:29.880945+00:00",
         "status":"open | locked",
         "state":"notification-state",
         "app_id":"your-app-id"
      }
   ],
   "meta":{  
      "request_id":"b14e0a62-2f42-4d0f-cd66-2e2667102931",
      "version":"2.0.0-beta.0",
      "status":200
   }
}

$notification_id = $response['data'][0]['id'];
```

### Get a Notification

Parameters:

* $notification_id: *string* [**required**];
* $token: *string* [optional];

```php
$push = new \BrunoCouty\IonicCloud\Services\Push();
$notification_id = "ff7eb700-0222-19fd-005a-7cb2473d0e11";
$response = $push->get($notification_id);
```

Response:

```php
{  
   "data":{  
      "status":"locked",
      "created":"2017-05-30T17:01:52.672599+00:00",
      "app_id":"your-app-id",
      "uuid":"notification-uuid-sent",
      "state":"enqueued",
      "config":{  
         "user_ids":[  
            "user-uuid"
         ],
         "profile":"certificate-profile",
         "notification":{  
            "payload":{  
               "key":"value"
            },
            "ios":{  
               "sound":"default",
               "content_available":1
            },
            "title":"notification-title",
            "message":"notification-text"
         }
      }
   },
   "meta":{  
      "status":200,
      "request_id":"7e240251-c686-412e-c116-374e97e648f1",
      "version":"2.0.0-beta.0"
   }
}
```

### Delete a notification

Parameters:

* $notification_id: *string* [**required**];
* $token: *string* [optional];

```php
$push = new \BrunoCouty\IonicCloud\Services\Push();
$notification_id = "ff7eb700-0222-19fd-005a-7cb2473d0e11";
$response = $push->delete($notification_id);
```

Response is a status code 200.


----------------

[<– Back to start](../readme.md)