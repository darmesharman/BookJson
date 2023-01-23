<?php

namespace App\Providers;

use App\Services\BooksJson\BooksJson;
use App\Services\BooksJson\FirstBooksJson;
use App\Services\BooksJson\SecondBooksJson;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\ServiceProvider;

class BooksJsonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(BooksJson::class, function ($app) {
            return function ($serviceName) : BooksJson
            {
                if ($serviceName == 'firstBooks') {
                    return new FirstBooksJson();
                }

                if ($serviceName == 'secondBooks') {
                    return new SecondBooksJson();
                }

                return new BooksJson;
            };
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
