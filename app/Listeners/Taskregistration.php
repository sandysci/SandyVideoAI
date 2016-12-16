<?php

namespace App\Listeners;

use App\Events\Taskregistration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Taskregistration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Taskregistration  $event
     * @return void
     */
    public function handle(Taskregistration $event)
    {
        //
    }
}
