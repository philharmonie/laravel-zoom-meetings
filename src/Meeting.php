<?php

namespace Philharmonie\LaravelZoomMeetings;

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
     */
    public function create(string $email, array $data): array
    {
        return Client::post('users/'.urlencode($email).'/meetings', $data, self::$access_token);
    }

    /**
     * @throws Exceptions\HttpException
     */
    public function delete(int $id): array
    {
        return Client::delete('meetings/'.$id, self::$access_token);
    }
}
