<?php

namespace Philharmonie\LaravelZoomMeetings\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Philharmonie\LaravelZoomMeetings\LaravelZoomMeetings
 */
class LaravelZoomMeetings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Philharmonie\LaravelZoomMeetings\LaravelZoomMeetings::class;
    }
}
