<?php

namespace Philharmonie\LaravelZoomMeetings\Support;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Philharmonie\LaravelZoomMeetings\Exceptions\MissingConfigException;

class Auth
{
    /**
     * @throws GuzzleException
     * @throws MissingConfigException
     */
    public static function getToken(): string
    {
        $account_id = config('zoom-meetings.account_id');
        $client_id = config('zoom-meetings.client_id');
        $client_secret = config('zoom-meetings.client_secret');

        if (! $account_id || ! $client_id || ! $client_secret) {
            throw new MissingConfigException('Zoom account_id, client_id and client_secret must be set in config/zoom.php');
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
