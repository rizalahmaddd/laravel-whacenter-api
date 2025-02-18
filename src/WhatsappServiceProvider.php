<?php

namespace Rizalahmaddd\WhatsappApi;

use Illuminate\Support\ServiceProvider;
use Rizalahmaddd\WhatsappApi\Helpers\WhatsappHelper;

class WhatsappServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/whatsapp.php', 'whatsapp');

        $this->app->singleton('whatsapp', function () {
            return new WhatsappHelper();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/whatsapp.php' => config_path('whatsapp.php'),
        ], 'config');
    }
}
