<?php

namespace Philharmonie\LaravelZoomMeetings\Exceptions;

use Exception;

class InvalidAccessTokenException extends Exception
{
    // @codeCoverageIgnoreStart
    public static function serviceRespondedWithAnError(Exception $exception): self
    {
        return new static($exception->getMessage());
    }
    // @codeCoverageIgnoreEnd
}
