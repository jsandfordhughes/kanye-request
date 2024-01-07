<?php

namespace App\Services\Quotes;

use App\Interfaces\QuoteApiDriver;
use Illuminate\Support\Facades\Http;

class KayneRestApiDriver implements QuoteApiDriver
{

    protected string $url = 'https://api.kanye.rest/';

    public function quote(): string|null
    {
        $request = Http::get($this->url);

        if ($request->failed()) {
            return null;
        }

        return $request->json('quote');
    }
}
