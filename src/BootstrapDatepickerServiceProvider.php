<?php

namespace Baijunyao\LaravelBootstrapDatepicker;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Baijunyao\LaravelBootstrapDatepicker\Middleware\BootstrapDatepicker;

class BootstrapDatepickerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/resources/statics' => public_path('statics'),
        ], 'public');
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware(BootstrapDatepicker::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
