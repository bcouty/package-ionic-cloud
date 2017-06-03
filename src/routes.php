<?php

Route::group(['prefix' => 'ionic-cloud', 'namespace' => 'BrunoCouty\IonicCloud\Controllers'], function () {
    Route::get('', ['uses' => 'PushController@index']);
    Route::get('/x', function () {
        $auth = new \BrunoCouty\IonicCloud\Services\Auth();
        return $auth->register(['name' => 'Bruno', 'email' => 'bruno@mail.com', 'password' => '123']);
    });
});