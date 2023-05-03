<?php

/** @noinspection PhpUnhandledExceptionInspection */

use Philharmonie\LaravelZoomMeetings\Meeting;
use Philharmonie\LaravelZoomMeetings\Support\Auth;

it('can create a meeting for the user', function () {
    $access_token = Auth::getToken();

    $meeting = Meeting::setAccessToken($access_token)->create('mail@example.de', [
        'topic' => 'Test Meeting',
        'type' => 2,
        'start_time' => now()->addDay()->startOfHour()->format('Y-m-d\TH:i:s'),
        'duration' => 60,
    ]);

    expect($meeting['status'])->toBe(201);

    return [
        'access_token' => $access_token,
        'id' => $meeting['body']['id'],
    ];
});

it('can delete a meeting', function ($data) {
    $deleted = Meeting::setAccessToken($data['access_token'])->delete($data['id']);

    expect($deleted['status'])->toBe(204);
})->depends('it can create a meeting for the user');
