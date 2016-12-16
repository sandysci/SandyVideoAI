<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Userregistration' => [
            'App\Listeners\Userregistration',
            'App\Listeners\Userlogin',
        ],
        'App\Events\Taskregistration' => [
            'App\Listeners\Taskregistration',
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    // $events->listen('event.*', function (array $data) {
    //
// });
    }
}
