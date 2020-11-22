<?php

namespace App\Events\Handlers;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Str;

class RefreshApiToken
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if ($event->user) {
            $token = Str::random(60);
            $event->user->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();
        }
    }
}
