<?php

namespace App\Listeners;

use App\Events\Userregistration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Userlogin
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
     * @param  Userregistration  $event
     * @return void
     */
    public function handle(Userregistration $event)
    {
        //
    }
}
