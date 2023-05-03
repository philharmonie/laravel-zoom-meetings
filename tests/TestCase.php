<?php

namespace Philharmonie\LaravelZoomMeetings\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Philharmonie\LaravelZoomMeetings\LaravelZoomMeetingsServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelZoomMeetingsServiceProvider::class,
        ];
    }
}
