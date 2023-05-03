<?php

namespace Philharmonie\LaravelZoomMeetings\Exceptions;

use Exception;

class MissingConfigException extends Exception
{
    public static function serviceRespondedWithAnError(Exception $exception): static
    {
        return new static($exception->getMessage());
    }
}
