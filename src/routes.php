<?php

Route::group(['prefix' => 'ionic-cloud', 'namespace' => 'BrunoCouty\IonicCloud\Controllers'], function () {
    Route::get('', ['uses' => 'PushController@index']);
});