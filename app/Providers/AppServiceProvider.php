<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;

class AppServiceProvider extends ServiceProvider
{
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
        \Braintree\Configuration::environment(env('BRAINTREE_ENV'));
        \Braintree\Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        \Braintree\Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        \Braintree\Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'jfpy6z53fqbp3hxt',
                'publicKey' => 'dxzf54h4h5yq6d4x',
                'privateKey' => 'a9edf4f3b6359c4e2ecd9887d9f8dc65'
            ]);
        });
    }
}
