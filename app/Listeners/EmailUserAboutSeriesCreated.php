<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Mail\SeriesCreated;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use Illuminate\Support\Facades\Mail;


class EmailUserAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {

        $userList = User::all();
        foreach($userList as $user){


                    $email = new SeriesCreated(

                        $event->seriesName,
                        $event->seriesId,
                        $event->seriesSeasonsQty,
                        $event->seriesEpisodesPerSeason
                    );

        Mail::to($user)->queue($email);

        }
    }
}
