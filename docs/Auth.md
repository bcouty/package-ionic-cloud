## Ionic Authentication Service

------------

The ionic authentication service work to manager users sessions in your ionic mobile app and the device tokens to send push notifications. Is very simple use this package. See below.

### Register an User

See the list of data that can be sent:

**data** an array with the user data:
- email [**required**];
- password [**required**];
- username [optional];
- name [optional];
- image [optional];
- custom [optional] - custom data array;

**token** and **app_id** are strings with the API Token and APP ID of you app. This is optional. Use **if you need send several different tokens in your application**. If your application use only one app on Ionic Cloud, you not need send this parameter, only configure the vars in "*config/ionic-cloud.php*" file.

Below see an example of register with vars configured in "*config/ionic-cloud.php*" file:

```
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

```
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

- data:
     - app_id;
     - created;
     - custom;
     - details [object];
     - social [object]
     - uuid;
- meta:
    - request_id;
    - status;
    - version;

If you want get the ***uuid***, for example, use:
 
```
$uuid = $response['data']['uuid']; 
```

### Retrieve the user data

Method parameters:

- $uuid: *string* [**required**];
- $token: *string* [optional]

```
$response = $auth->get($uuid);
```

Return data:

```
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

```
echo $response['data']['email'];
```

### Update the user data

Method parameters:

- $uuid: *string* [**required**];
- $data: *array* [**required**];
- $token *string* [optional];

```
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

```
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

```
$response = $auth->delete($uuid);
```

Return:

```
[]
```

----------------

[<– Back to start](../)