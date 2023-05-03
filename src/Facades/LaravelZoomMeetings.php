<?php

namespace Philharmonie\LaravelZoomMeetings\Facades;

use Illuminate\Support\Facades\Facade;
use Philharmonie\LaravelZoomMeetings\Meeting;

/**
 * @see \Philharmonie\LaravelZoomMeetings\Facades\Meeting
 */
class LaravelZoomMeetings extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Meeting::class;
    }
}
