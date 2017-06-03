<?php

namespace BrunoCouty\IonicCloud\Services;


use GuzzleHttp\Client;

class Auth
{
    public function register(array $data, string $token = '', string $app_id = '')
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
        if($token == '') {
            $token = config('ionic-cloud.token');
        }
        if($app_id == '') {
            $app_id = config('ionic-cloud.app_id');
        }
        $fields['app_id'] = $app_id;
        $data = [
            'json' => [
                $fields
            ]
        ];
        $guzzle = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
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