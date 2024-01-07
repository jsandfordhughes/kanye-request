<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getJsonAuthenticated(string $url)
    {
        $apiKey = config('api_authentication.apiKeys')[0];

        return $this->getJson($url . "?api_key=$apiKey");
    }
}
