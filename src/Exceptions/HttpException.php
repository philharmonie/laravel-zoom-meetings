<?php

namespace Philharmonie\LaravelZoomMeetings\Exceptions;

use Exception;
use Throwable;

class HttpException extends Exception
{
    // @codeCoverageIgnoreStart
    public function __construct(private $response, $message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function new(string $url, int $status, string $message, $response): HttpException
    {
        return new self(
            $response,
            sprintf(
                'Http request to %s failed with a status of %d and error message: %s',
                $url, $status, $message
            )
        );
    }

    public function getResponse()
    {
        return $this->response;
    }
    // @codeCoverageIgnoreEnd
}
