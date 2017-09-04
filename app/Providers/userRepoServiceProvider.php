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

        $this->app->bind('App\Repositories\Language\languageInterface', 'App\Repositories\Language\languageRepository');

        $this->app->bind('App\Repositories\userLanguage\userLanguageInterface', 'App\Repositories\userLanguage\userLanguageRepository');

        $this->app->bind('App\Repositories\Subscription\subscriptionInterface', 'App\Repositories\Subscription\subscriptionRepository');

        $this->app->bind('App\Repositories\UserSubscription\userSubscriptionInterface', 'App\Repositories\UserSubscription\userSubscriptionRepository');

        $this->app->bind('App\Repositories\Profession\professionInterface', 'App\Repositories\Profession\professionRepository');

        $this->app->bind('App\Repositories\Group\groupInterface', 'App\Repositories\Group\groupRepository');

        $this->app->bind('App\Repositories\Question\questionInterface', 'App\Repositories\Question\questionRepository');

        $this->app->bind('App\Repositories\Answer\answerInterface', 'App\Repositories\Answer\answerRepository');

    }
}