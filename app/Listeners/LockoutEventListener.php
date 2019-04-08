<?php

namespace App\Listeners;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LockoutEventListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Lockout $event)
    {

        if ( $event->request->has('email')){

            $user = User::where('email', $event->request->input('email'))->first();
            $user->status = \USER_STATUS_SUSPENDED;
            $user->save();

        }

        // @TODO send notification to user about suspended and contact to user;

    }
}
