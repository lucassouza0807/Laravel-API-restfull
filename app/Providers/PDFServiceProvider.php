<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PDFServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Barryvdh\DomPDF\ServiceProvider::class, function ($app) {
            return new \Barryvdh\DomPDF\ServiceProvider(config("dompdf"));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
