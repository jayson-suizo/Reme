<?php 
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class userRepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\User\userInterface', 'App\Repositories\User\userRepository');
        
        $this->app->bind('App\Repositories\Activity\activityInterface', 'App\Repositories\Activity\activityRepository');


    }
}