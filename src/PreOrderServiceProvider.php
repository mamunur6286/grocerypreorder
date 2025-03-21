<?php

namespace GroceryStore\PreOrderManagement;

use GroceryStore\PreOrderManagement\Constant\Constant;
use GroceryStore\PreOrderManagement\Events\PreOrderEmailEvent;
use GroceryStore\PreOrderManagement\Listeners\SendPreOrderEmailConfirmation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider as LaravelProvider;

class PreOrderServiceProvider extends LaravelProvider
{
    protected $rootPath;

     /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->rootPath = realpath(__DIR__.'/../');
        
    }

    public function boot()
    {
        Event::listen(PreOrderEmailEvent::class, SendPreOrderEmailConfirmation::class);

        $this->publishes([
            __DIR__.'/../config/preorder.php' => config_path('preorder.php'),
        ], 'preorder-config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'preorder-migrations');

        // $this->loadMigrationsFrom($this->rootPath . '/database/migrations');
        $this->loadViewsFrom($this->rootPath . '/resources/views', Constant::PACKAGE_NAME);
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->mergeConfigFrom(__DIR__.'/../config/preorder.php', Constant::PACKAGE_NAME);

        $this->commands([
            //
        ]);
    }
}
