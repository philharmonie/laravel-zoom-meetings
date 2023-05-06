<?php

namespace Philharmonie\LaravelZoomMeetings;

use Philharmonie\LaravelZoomMeetings\Exceptions\HttpException;
use Philharmonie\LaravelZoomMeetings\Exceptions\InvalidAccessTokenException;
use Philharmonie\LaravelZoomMeetings\Support\Client;

class Meeting
{
    protected static string $access_token;

    public static function setAccessToken(string $access_token): meeting
    {
        self::$access_token = $access_token;

        return new meeting();
    }

    /**
     * @throws Exceptions\HttpException
     * @throws InvalidAccessTokenException
     */
    public function create(array $data, string|null $userId = null): array
    {
        if (! $userId) {
            $userId = 'me';
        }

        return Client::post('users/'.urlencode($userId).'/meetings', $data, self::$access_token);
    }

    /**
     * @throws Exceptions\HttpException
     * @throws InvalidAccessTokenException
     */
    public function delete(int $id): array
    {
        return Client::delete('meetings/'.$id, self::$access_token);
    }

    /**
     * @throws HttpException
     * @throws InvalidAccessTokenException
     */
    public function findBy(string $field, string $value, string $userId = null): array
    {
        if (! $userId) {
            $userId = 'me';
        }

        $meetings = Client::get('users/'.urlencode($userId).'/meetings', self::$access_token);

        foreach ($meetings['body']['meetings'] as $meeting) {
            if ($meeting[$field] === $value) {

                return $meeting;
            }
        }

        return [];
    }
}
