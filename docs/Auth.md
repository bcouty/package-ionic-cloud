## Ionic Authentication Service

------------

The ionic authentication service work to manager users sessions in your ionic mobile app and the device tokens to send push notifications. Is very simple use this package. See below.

### List Users Registered

Returns a paginated collection of Users

Parameters:

* $page_size: *int* [optional] - Number limit of registers per page (default: 0 - Set 0 to no limit);
* $page: *int* [optional] - Number of page (default 1);
* $token: *string* [optional] - The token of your ionic app (if you use this library to work with more than one app);

```php
$auth = new \BrunoCouty\IonicCloud\Services\Auth();
$response = $auth->list();
```

Response:

```php
{  
   "meta":{  
      "status":200,
      "request_id":"a70f2051-ee71-4671-c625-79ddef059a1f",
      "version":"2.0.0-beta.0"
   },
   "data":[  
      {  
         "type":"ionic",
         "custom":[  

         ],
         "created":"2017-06-03T18:22:12Z",
         "groups":[  

         ],
         "details":{  
            "username":"user-username",
            "image":"url",
            "name":"name",
            "email":"email"
         },
         "uuid":"user-uuid",
         "social":[  

         ],
         "app_id":"app-id"
      }
   ]
}
```

### Register an User

See the list of data that can be sent:

* $data: *array*:
    * email [**required**];
    * password [**required**];
    * username [optional];
    * name [optional];
    * image [optional];
    * custom [optional] - custom data array;

* $token: *string* [optional];
* $app_id: *string* [optional]; 

**Note:** *token* and *app_id* are strings with the API Token and APP ID of you app. This are optional. Use **if you need send several different tokens in your application**. If your application use only one app on Ionic Cloud, you not need send this parameter, only configure the vars in "*config/ionic-cloud.php*" file.

Below see an example of register with vars configured in "*config/ionic-cloud.php*" file:

```php
    $auth = new \BrunoCouty\IonicCloud\Services\Auth();
    $data = [
        'email' => 'brunocouty@gmail.com',
        'password' => 'foxtrot',
        'name' => 'Bruno Couty',
        'custom' => [
            'gender' => 'M',
            'country' => 'Brazil'
        ]
    ];
    $response = $auth->register($data);
```

Below, see an example of register in different applications, sending the API Token and App ID on method:

```php
    $auth = new \BrunoCouty\IonicCloud\Services\Auth();
    $data = [
        'email' => 'brunocouty@gmail.com',
        'password' => 'foxtrot',
        'name' => 'Bruno Couty',
        'custom' => [
            'gender' => 'M',
            'country' => 'Brazil'
        ]
    ];
    $token = 'your-api-token';
    $app_id = '891IaDs';
    $response = $auth->register($data, $token, $app_id);
```


If everything it's ok, your will receive as return status 200 with the fields:

```php
{  
   "data":{  
      "app_id":"your-app-id",
      "social":[  

      ],
      "created":"2017-06-05T18:31:34Z",
      "custom":{  
         "country":"Brazil",
         "gender":"M"
      },
      "type":"ionic",
      "uuid":"your-user-id",
      "details":{  
         "email":"brunocouty@gmail.com",
         "image":"https:\/\/s3.amazonaws.com\/ionic-api-auth\/users-default-avatar@2x.png",
         "username":null,
         "name":"Bruno Couty"
      },
      "groups":[  

      ]
   },
   "meta":{  
      "status":201,
      "version":"2.0.0-beta.0",
      "request_id":"e8d8341f-5c79-4da6-cd83-32e9d4da451e"
   }
}
```

If you want get the ***uuid***, for example, use:
 
```php
$uuid = $response['data']['uuid']; 
```

### Retrieve data of an user

Method parameters:

- $uuid: *string* [**required**];
- $token: *string* [optional]

```php
$response = $auth->get($uuid);
```

Return data:

```php
{  
   "meta":{  
      "request_id":"b87f9aae-8fdd-4ab4-ca97-4eb09812117b",
      "status":200,
      "version":"2.0.0-beta.0"
   },
   "data":{  
      "app_id":"your-app-id",
      "social":[  
          ...
      ],
      "groups":[  
          ...
      ],
      "custom":[  
          ...
      ],
      "uuid":"uuid-of-your-user",
      "details":{  
         "name":"user-name",
         "email":"user-email",
         "username":null,
         "image":"path-to-image"
      },
      "type":"ionic",
      "created":"2017-06-03T18:23:10Z"
   }
}
```

Get email:

```php
echo $response['data']['email'];
```

### Update the user data

Method parameters:

- $uuid: *string* [**required**];
- $data: *array* [**required**];
- $token *string* [optional];

```php
$data = [
        'email' => 'brunocouty@gmail.com',
        'password' => 'foxtrot fired!',
        'name' => 'Bruno Couty',
        'custom' => [
            'gender' => 'M',
            'country' => 'Brazil'
        ]
    ];
$response = $auth->update($uuid, $data);
```

Response:

```php
{  
   "meta":{  
      "request_id":"b87f9aae-8fdd-4ab4-ca97-4eb09812117b",
      "status":200,
      "version":"2.0.0-beta.0"
   },
   "data":{  
      "app_id":"your-app-id",
      "social":[  
          ...
      ],
      "groups":[  
          ...
      ],
      "custom":[  
          ...
      ],
      "uuid":"uuid-of-your-user",
      "details":{  
         "name":"user-name",
         "email":"user-email",
         "username":null,
         "image":"path-to-image"
      },
      "type":"ionic",
      "created":"2017-06-03T18:23:10Z"
   }
}
```

### Delete an user

Method parameters:

- $uuid: *string* [**required**];
- $token: *string* [optional];

```php
$response = $auth->delete($uuid);
```

Return:

```php
[]
```

----------------

[<– Back to start](../readme.md)