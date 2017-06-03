<?php

namespace BrunoCouty\IonicCloud\Services;

use GuzzleHttp\Client;

class Push
{
    public function send(
        string $title,
        string $message,
        array $uuid,
        array $data = [])
    {
        return "ok";
        $token = config('ionic-cloud.api_token');
        $profile = config('ionic-cloud.profile');
        $guzzle = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'form-data',
                'Accept' => 'application/json',
            ]
        ]);
        $response = $guzzle->post('https://api.ionic.io/push/notifications', ['json' => [
            'user_ids' => $uuid,
            'profile' => $profile,
            'notification' => [
                'title' => $title,
                'message' => $message,
                'ios' => [
                    'sound' => 'default',
                    'content_available' => 1
                ],
                'payload' => [
                    'data' => $data
                ]
            ],
        ]]);
        if ($response->getStatusCode() != 200 && $response->getStatusCode() != 201) {
            return $response->getStatusCode();
        }
        return json_decode((string)$response->getBody(), true);
    }
}