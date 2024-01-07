<?php

namespace App\Services\Quotes;

use App\Interfaces\QuoteApiDriver;
use Illuminate\Support\Manager;

class QuotesManager extends Manager
{

    public function createKayneDriver(): QuoteApiDriver
    {
        return new KayneRestApiDriver();
    }
    public function getDefaultDriver()
    {
        return $this->config->get('quotes.driver', 'kayne');
    }
}
