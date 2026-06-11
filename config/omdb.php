<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OMDB API Configuration
    |--------------------------------------------------------------------------
    |
    | API Key dapat diperoleh dari: http://www.omdbapi.com/apikey.aspx
    |
    */

    'api_key' => env('OMDB_API_KEY', ''),
    'base_url' => env('OMDB_BASE_URL', 'http://www.omdbapi.com/'),
];
