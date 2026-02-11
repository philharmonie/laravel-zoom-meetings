<?php

return [
    'account_id' => env('ZOOM_ACCOUNT_ID'),
    'client_id' => env('ZOOM_CLIENT_ID'),
    'client_secret' => env('ZOOM_CLIENT_SECRET'),
    'base_url' => 'https://api.zoom.us/v2/',
    'token_url' => 'https://zoom.us/oauth/token',

    /*
    |--------------------------------------------------------------------------
    | Token Cache TTL (seconds)
    |--------------------------------------------------------------------------
    |
    | Zoom OAuth tokens are valid for 1 hour. This setting controls how long
    | the token is cached. Set to 0 to disable caching.
    |
    */
    'token_cache_ttl' => env('ZOOM_TOKEN_CACHE_TTL', 3500),
];
