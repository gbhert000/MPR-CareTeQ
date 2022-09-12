<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Components\FlashMessages;
use Illuminate\Support\Facades\URL;

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
        // URL::forceScheme('https');
        view()->composer('partials.messages', function ($view) {

            $messages = self::messages();
  
            return $view->with('messages', $messages);
        });
    }


}
