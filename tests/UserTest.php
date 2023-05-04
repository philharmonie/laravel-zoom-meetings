<?php

/** @noinspection PhpUnhandledExceptionInspection */

/** @noinspection LaravelFunctionsInspection */

use Philharmonie\LaravelZoomMeetings\Support\Auth;
use Philharmonie\LaravelZoomMeetings\User;

it('can get me', function () {
    $access_token = Auth::getToken();
    $user = User::setAccessToken($access_token)->me();

    expect($user['status'])->toBe(200);
});

it('can get all users', function () {
    $access_token = Auth::getToken();
    $users = User::setAccessToken($access_token)->all();

    expect($users['status'])->toBe(200);
});

it('can get user by email address', function () {
    $access_token = Auth::getToken();
    $user = User::setAccessToken($access_token)->find(config('zoom.email_account'));

    expect($user['status'])->toBe(200);
});

it('can get user\'s meetings', function () {
    $access_token = Auth::getToken();
    $user = User::setAccessToken($access_token)->find(config('zoom.email_account'));

    $meetings = User::setAccessToken($access_token)->meetings($user['body']['email']);

    expect($meetings['status'])->toBe(200);

});
