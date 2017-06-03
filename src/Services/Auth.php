<?php

namespace BrunoCouty\IonicCloud\Services;


use GuzzleHttp\Client;

class Auth
{
    public function register($data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            if ($key == 'custom') {
                foreach ($value as $k => $v) {
                    $fields[$key][$k] = $v;
                }
            }
            $fields[$key] = $value;
        }
        $application_token = config('ionic-cloud.token');
        $app_id = config('ionic-cloud.app_id');
        $fields['app_id'] = $app_id;
        $data = [
            'json' => [
                $fields
            ]
        ];
        $guzzle = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $application_token,
                'Content-Type' => 'form-data',
            ]
        ]);
        $response = $guzzle->post('https://api.ionic.io/auth/users', $data);
        if ($response->getStatusCode() != 201) {
            return $response->getStatusCode();
        }
        return json_decode((string)$response->getBody(), true);
    }
}