<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
         User::creating(function ($user) {
                // dd('sandy4life22'.str_random(10).'@yahoo.com');
                // $u= new User;
                // $u->name="sandyy";
                // $u->email='sandy4life22'.str_random(10).'@yahoo.com';
                // $u->password='qwerty';
                // $u->save();
            
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
