<?php

return [
    /*
    |--------------------------------------------------------------------------
    | JobAway Integration Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for integrating with JobAway frontend application
    |
    */

    'api_url' => env('JOBAWAY_API_URL', 'http://localhost:8000'),
    'api_timeout' => env('JOBAWAY_API_TIMEOUT', 10),
    
    /*
    |--------------------------------------------------------------------------
    | API Authentication
    |--------------------------------------------------------------------------
    |
    | If the JobAway API requires authentication, configure it here
    |
    */
    
    'api_key' => env('JOBAWAY_API_KEY'),
    'api_secret' => env('JOBAWAY_API_SECRET'),
    
    /*
    |--------------------------------------------------------------------------
    | Database Settings
    |--------------------------------------------------------------------------
    |
    | Configure if both projects should use the same database
    |
    */
    
    'shared_database' => env('JOBAWAY_SHARED_DATABASE', true),
];