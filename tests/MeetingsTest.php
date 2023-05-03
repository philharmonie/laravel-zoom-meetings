<?php

/** @noinspection PhpUnhandledExceptionInspection */

use Philharmonie\LaravelZoomMeetings\Meeting;
use Philharmonie\LaravelZoomMeetings\Support\Auth;

it('can create a meeting for me', function () {
    $access_token = Auth::getToken();

    $meeting = Meeting::setAccessToken($access_token)->create([
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

it('can create a meeting for the user', function () {
    $access_token = Auth::getToken();

    $meeting = Meeting::setAccessToken($access_token)->create([
        'topic' => 'Test Meeting',
        'type' => 2,
        'start_time' => now()->addDay()->startOfHour()->format('Y-m-d\TH:i:s'),
        'duration' => 60,
    ], env('ZOOM_EMAIL_ACCOUNT'));

    expect($meeting['status'])->toBe(201);

    return [
        'access_token' => $access_token,
        'id' => $meeting['body']['id'],
    ];
});

it('can delete a meeting for me', function ($data) {
    $deleted = Meeting::setAccessToken($data['access_token'])->delete($data['id']);

    expect($deleted['status'])->toBe(204);
})->depends('it can create a meeting for me');

it('can delete a meeting for user', function ($data) {
    $deleted = Meeting::setAccessToken($data['access_token'])->delete($data['id']);

    expect($deleted['status'])->toBe(204);
})->depends('it can create a meeting for the user');

it('can find meeting by join_url', function () {
    $access_token = Auth::getToken();

    $meeting = Meeting::setAccessToken($access_token)->create([
        'topic' => 'Test Meeting',
        'type' => 2,
        'start_time' => now()->addDay()->startOfHour()->format('Y-m-d\TH:i:s'),
        'duration' => 60,
    ]);

    $found_meeting = Meeting::setAccessToken($access_token)->findBy('join_url', $meeting['body']['join_url']);

    expect($found_meeting['join_url'])->toBe($meeting['body']['join_url']);

    Meeting::setAccessToken($access_token)->delete($meeting['body']['id']);
});
