<?php

return [
    // Your API Token from Ionic Cloud Account
    // You can see in: Your App > Settings > API Keys
    'api_token' => env('IONIC_CLOUD_API_TOKEN', 'your-api-token'), // required!
    'profile' => env('IONIC_CLOUD_PROFILE', 'your-profile-certificates'), // for push notifications
    'app_id' => env('IONIC_CLOUD_APP_ID', 'your-app-id'), // for auth service
];