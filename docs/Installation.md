## Installation

Install with composer:

```
composer require brunocouty/ionic-cloud
```

Open "*config/app.php*" and register this package in providers array:

``` 
BrunoCouty\IonicCloud\IonicCloudServiceProvider::class,
```

Now, publish the configuration file:

```
php artisan vendor:publish --provider="BrunoCouty\IonicCloud\IonicCloudServiceProvider"
```
--------------------

## Configuration

Open "*config/ionic-cloud.php*".

You can create three vars in your *.env* file or set the values in self config file.

The vars to *.env* file are:

Need to Push Notifications:

- IONIC_CLOUD_API_TOKEN (*Ionic IO Account / Your App / Settings / API Keys*);
- IONIC_CLOUD_PROFILE (*Ionic IO Account / Your App / Settings / Certificates*);

Need to Auth:

- IONIC_CLOUD_APP_ID (*The ID of your app*);

```
'api_token' => env('IONIC_CLOUD_API_TOKEN', 'your-api-token'), // required!
'profile' => env('IONIC_CLOUD_PROFILE', 'your-profile-certificates'), // for push notifications
'app_id' => env('IONIC_CLOUD_APP_ID', 'your-app-id'), // for auth service
```

--------------------

----------------

[<– Back to start](../readme.md)