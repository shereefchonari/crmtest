<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Services\ContactCreationService;


class ContactServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ContactCreationService::class, function ($app) {
        return new ContactCreationService();
    });

}


public function boot()
{
}

}