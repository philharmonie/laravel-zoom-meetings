<?php

namespace Philharmonie\LaravelZoomMeetings\Support;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Philharmonie\LaravelZoomMeetings\Exceptions\MissingConfigException;

class Auth
{
    /**
     * Get a cached Zoom OAuth access token.
     * Tokens are valid for 1 hour; cached for ~58 minutes.
     *
     * @throws GuzzleException
     * @throws MissingConfigException
     */
    public static function getToken(): string
    {
        $cacheKey = 'zoom_access_token';
        $cacheTtl = (int) config('zoom-meetings.token_cache_ttl', 3500);

        if ($cacheTtl <= 0) {
            return self::fetchToken();
        }

        return Cache::remember($cacheKey, $cacheTtl, fn () => self::fetchToken());
    }

    /**
     * Fetch a fresh token from Zoom OAuth.
     *
     * @throws GuzzleException
     * @throws MissingConfigException
     */
    private static function fetchToken(): string
    {
        $account_id = config('zoom-meetings.account_id');
        $client_id = config('zoom-meetings.client_id');
        $client_secret = config('zoom-meetings.client_secret');

        if (! $account_id || ! $client_id || ! $client_secret) {
            throw new MissingConfigException('Zoom account_id, client_id and client_secret must be set in config/zoom-meetings.php');
        }

        $client = new Client([
            'headers' => [
                'Authorization' => 'Basic '.base64_encode($client_id.':'.$client_secret),
                'Host' => 'zoom.us',
            ],
        ]);

        $response = $client->request('POST', config('zoom-meetings.token_url'), [
            'form_params' => [
                'grant_type' => 'account_credentials',
                'account_id' => $account_id,
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return $responseBody['access_token'];
    }
}
