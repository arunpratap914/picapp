<?php

namespace App\Listeners;

use App\Jobs\SendEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WelcomeUserListner
{
    public function __construct()
    { }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        SendEmailJob::dispatch($event->user)->delay(now()->addSeconds(2));
    }
}
