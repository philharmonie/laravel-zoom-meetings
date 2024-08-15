<?php

namespace Philharmonie\LaravelZoomMeetings\Exceptions;

use Exception;
use Throwable;

class HttpException extends Exception
{
    // @codeCoverageIgnoreStart
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        if (is_array($message)) {
            $message = json_encode($message);
        }

        parent::__construct($message, $code, $previous);
    }

    public static function new(string $url, int $status, string $message, $response): HttpException
    {
        $responseMessage = is_array($response) ? json_encode($response) : $response;

        return new self(
            sprintf(
                'Http request to %s failed with a status of %d and error message: %s. Response: %s',
                $url, $status, $message, $responseMessage
            )
        );
    }
    // @codeCoverageIgnoreEnd
}
