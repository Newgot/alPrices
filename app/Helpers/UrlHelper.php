<?php

namespace App\Helpers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class UrlHelper
{
    public static function prices(string $endpoint): Response
    {
        return Http::get('https://west.albion-online-data.com/api/v2/stats/prices/' . $endpoint);
    }
}
