<?php

namespace Zubair\Fetchr;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class FetchrServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/fetchr.php' => config_path('fetchr.php'),
        ]);

        $this->app->alias('Fetchr', 'Zubair\Fetchr\Facades\Fetchr');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('fetchr',function($app) 
        {
            return new Fetchr(new Client);
        });
    }
}
