<?php

namespace BrunoCouty\IonicCloud\Services;

use GuzzleHttp\Client;

class Push
{
    /**
     * Paginated listing of Push Notifications for an App
     * @param int $page_size
     * @param int $page
     * @param string $token
     * @return int|mixed
     */
    public function list(int $page_size = 0, int $page = 1,string $token = '')
    {
        if ($token == '') {
            $token = config('ionic-cloud.token');
        }
        $page_size_field = '';
        if($page_size > 0) {
            $page_size_field = "&page_size={$page_size}";
        }
        $guzzle = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
        $response = $guzzle->get("https://api.ionic.io/push/notifications?page={$page}&fields[]=overview&fields[]=message_total{$page_size_field}");
        if ($response->getStatusCode() != 200) {
            return $response->getStatusCode();
        }
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Create a Push Notification
     * @param string $title
     * @param string $message
     * @param array $uuid
     * @param array $data
     * @param string $token
     * @param string $profile
     * @return int|mixed
     */
    public function send(
        string $title,
        string $message,
        array $uuid,
        array $data = [],
        string $token = '',
        string $profile = '')
    {
        if ($token == '') {
            $token = config('ionic-cloud.api_token');
        }
        if ($profile == '') {
            $profile = config('ionic-cloud.profile');
        }
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

    public function get(string $notification_id, string $token = '')
    {
        if ($token == '') {
            $token = config('ionic-cloud.token');
        }
        $guzzle = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
        $response = $guzzle->get("https://api.ionic.io/push/notifications/{$notification_id}");
        if ($response->getStatusCode() != 200) {
            return $response->getStatusCode();
        }
        return json_decode((string)$response->getBody(), true);
    }
}