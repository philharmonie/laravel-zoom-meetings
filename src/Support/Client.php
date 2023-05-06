<?php

namespace Philharmonie\LaravelZoomMeetings\Support;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Philharmonie\LaravelZoomMeetings\Exceptions\HttpException;
use Philharmonie\LaravelZoomMeetings\Exceptions\InvalidAccessTokenException;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

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
     * @throws InvalidAccessTokenException
     */
    public static function get(string $uri, string $access_token): array
    {
        $response = http::withHeaders(self::requestHeaders($access_token))
            ->get(config('zoom-meetings.base_url').$uri);

        return self::handleResponse($response, $uri);
    }

    /**
     * @throws httpexception
     * @throws InvalidAccessTokenException
     */
    public static function post(string $uri, array $data, string $access_token): array
    {
        $response = Http::withHeaders(self::requestHeaders($access_token))
            ->post(config('zoom-meetings.base_url').$uri, $data);

        return self::handleResponse($response, $uri);
    }

    /**
     * @throws HttpException
     * @throws InvalidAccessTokenException
     */
    public static function delete(string $uri, string $access_token): array
    {
        $response = Http::withHeaders(self::requestHeaders($access_token))
            ->delete(config('zoom-meetings.base_url').$uri);

        return self::handleResponse($response, $uri);
    }

    /**
     * @throws HttpException
     * @throws InvalidAccessTokenException
     */
    private static function handleResponse(Response $response, $uri): array
    {
        if ($response->failed()) {
            if ($response->status() === BaseResponse::HTTP_UNAUTHORIZED) {
                throw new InvalidAccessTokenException($response->body());
            }

            $message = $response->json('error_message', 'Unknown error');
            throw HttpException::new($uri, $response->status(), $message, $response->json());
        }

        return [
            'status' => $response->status(),
            'body' => json_decode($response->body(), true),
        ];
    }
}
