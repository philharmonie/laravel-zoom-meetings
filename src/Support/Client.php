<?php

namespace Philharmonie\LaravelZoomMeetings\Support;

use Illuminate\Support\Facades\Http;
use Philharmonie\LaravelZoomMeetings\Exceptions\HttpException;

class Client
{
    private static function requestHeaders(string $access_token): array
    {
        return [
            'authorization' => 'bearer '.$access_token,
            'accept' => 'application/json',
        ];
    }

    /**
     * @throws httpexception
     */
    public static function get(string $uri, string $access_token): array
    {
        $response = http::withHeaders(self::requestHeaders($access_token))
            ->get(config('zoom-meetings.base_url').$uri);

        return self::handleResponse($response, $uri);
    }

    /**
     * @throws httpexception
     */
    public static function post(string $uri, array $data, string $access_token): array
    {
        $response = Http::withHeaders(self::requestHeaders($access_token))
            ->post(config('zoom-meetings.base_url').$uri, $data);

        return self::handleResponse($response, $uri);
    }

    /**
     * @throws HttpException
     */
    public static function delete(string $uri, string $access_token): array
    {
        $response = Http::withHeaders(self::requestHeaders($access_token))
            ->delete(config('zoom-meetings.base_url').$uri);

        return self::handleResponse($response, $uri);
    }

    /**
     * @throws HttpException
     */
    private static function handleResponse($response, $uri): array
    {
        if ($response->failed()) {
            $message = $response->json('error_message', 'unknown error');
            throw HttpException::new($uri, $response->status(), $message, $response->json());
        }

        return [
            'status' => $response->status(),
            'body' => json_decode($response->getbody(), true),
        ];
    }
}
