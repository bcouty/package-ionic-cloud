<?php

namespace BrunoCouty\IonicCloud;

use Illuminate\Support\ServiceProvider;

class IonicCloudServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require_once __DIR__ . '/routes.php';
        $this->publishes([
            __DIR__ . '/resources/config/ionic-cloud.php' => config_path('ionic-cloud.php'),
        ]);
    }

    public function register()
    {

    }

}