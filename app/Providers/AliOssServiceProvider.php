<?php

namespace App\Providers;

use App\Services\StorageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AliOssServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('ali-oss',function ($app, $config) {
            return new StorageService($config);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
