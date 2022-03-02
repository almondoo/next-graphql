<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['get', 'post', 'put', 'delete'],

    'allowed_origins' => [env('ACCESS_CONTROLL_ALLOWED_ORIGINS')],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Content-Type', ' Accept', ' Authorization', ' X-Requested-With', ' X-XSRF-TOKEN'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
