<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Components\FlashMessages;

class AppServiceProvider extends ServiceProvider
{

    use FlashMessages;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
        view()->composer('partials.messages', function ($view) {

            $messages = self::messages();
  
            return $view->with('messages', $messages);
        });
    }


}
