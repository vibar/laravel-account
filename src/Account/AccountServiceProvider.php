<?php

namespace Vibar\Account;


use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadTranslationsFrom(resource_path('lang'), 'account');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/account'),
        ], 'translations');

        $this->loadViewsFrom(resource_path('views'), 'account');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/account'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/account.php' => config_path('account.php')
        ], 'config');
    }
}
