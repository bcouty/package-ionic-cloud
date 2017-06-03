<?php

namespace BrunoCouty\IonicCloud\Services;


use GuzzleHttp\Client;

class Auth
{
    /**
     * @param array $data
     * @param string $token
     * @param string $app_id
     * @return int|mixed
     */
    public function register(array $data, string $token = '', string $app_id = '')
    {
        $fields = [];
        foreach ($data as $key => $value) {
            if ($key == 'custom') {
                foreach ($value as $k => $v) {
                    $fields['json'][$key][$k] = $v;
                }
            }
            $fields['json'][$key] = $value;
        }
        if ($token == '') {
            $token = config('ionic-cloud.token');
        }
        if ($app_id == '') {
            $app_id = config('ionic-cloud.app_id');
        }
        $fields['json']['app_id'] = $app_id;
        $data = $fields;
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

    /**
     * @param string $uuid
     * @param string $token
     * @return int|mixed
     */
    public function get(string $uuid, string $token = '')
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
        $response = $guzzle->get('https://api.ionic.io/auth/users/' . $uuid);
        if ($response->getStatusCode() != 200) {
            return $response->getStatusCode();
        }
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * @param string $uuid
     * @param array $data
     * @param string $token
     * @return int|mixed
     */
    public function update(string $uuid, array $data, string $token = '')
    {
        $fields = [];
        foreach ($data as $key => $value) {
            if ($key == 'custom') {
                foreach ($value as $k => $v) {
                    $fields['json'][$key][$k] = $v;
                }
            }
            $fields['json'][$key] = $value;
        }
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
        $data = $fields;
        $response = $guzzle->patch('https://api.ionic.io/auth/users/' . $uuid, $data);
        if ($response->getStatusCode() != 200) {
            return $response->getStatusCode();
        }
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * @param string $uuid
     * @param string $token
     * @return \Illuminate\Contracts\Routing\ResponseFactory|int|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(string $uuid, string $token = '')
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
        $response = $guzzle->delete('https://api.ionic.io/auth/users/' . $uuid);
        if ($response->getStatusCode() != 204) {
            return $response->getStatusCode();
        }
        return response([], 200);
    }
}