<?php

namespace Philharmonie\LaravelZoomMeetings\Commands;

use Illuminate\Console\Command;

class LaravelZoomMeetingsCommand extends Command
{
    public $signature = 'laravel-zoom-meetings';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
