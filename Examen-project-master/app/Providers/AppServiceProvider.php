<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Newsletter;
use App\Services\MailChimpNewsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use Nette\Utils\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    // !!Mailchimp service will be removed
    // public function register()
    // {
    //     app()->bind(Newsletter::class, function() {


    //         $client = (new ApiClient)->setConfig([
    //             'apiKey' => config('services.mailchimp.key'),
    //             'server' => 'us11'
    //         ]);

    //         return new  MailChimpNewsletter($client);
    //     });
    // }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Gate::define('admin', function (User $user){
            return $user->username == 'admin10';
        });

        Blade::if('admin', function (){
            return request()->user()?->can('admin');
        });
    }
}
