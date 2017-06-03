<?php

namespace BrunoCouty\IonicCloud;

use Illuminate\Support\ServiceProvider;

class IonicCloudServiceProvider extends ServiceProvider
{
    public function boot()
    {
        include __DIR__ .  '/routes.php';
    }

    public function register()
    {
//        $this->app['ionic-cloud'] = $this->app->share(function ($app) {
//            return new IonicCloud;
//        });
    }
}