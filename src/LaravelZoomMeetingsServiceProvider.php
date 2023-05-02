<?php

namespace Philharmonie\LaravelZoomMeetings;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Philharmonie\LaravelZoomMeetings\Commands\LaravelZoomMeetingsCommand;

class LaravelZoomMeetingsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-zoom-meetings')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-zoom-meetings_table')
            ->hasCommand(LaravelZoomMeetingsCommand::class);
    }
}
