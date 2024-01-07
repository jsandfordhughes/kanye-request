<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;

// Quotes Api
test('it returns 5 quotes', function () {

    fakeQuotes();

    $this->getJsonAuthenticated('api/quotes')
        ->assertJson(fn(AssertableJson $json) => $json->has('quotes', 5)
        );
});

test('it returns the 5 quotes from the cache', function () {

    fakeQuotes();

    expect(\Illuminate\Support\Facades\Cache::has('5-quotes'))->toBeFalse();

    $this->getJsonAuthenticated('api/quotes')
        ->assertJson(fn(AssertableJson $json) => $json->has('quotes', 5)
        );

    expect(\Illuminate\Support\Facades\Cache::has('5-quotes'))->toBeTrue();

    $this->getJsonAuthenticated('api/quotes')
        ->assertJson(fn(AssertableJson $json) => $json->has('quotes', 5)
        );
});

//Quotes Refresh API
test('it refreshes the quotes in the cache and returns new ones', function () {

    fakeQuotes();

    $oldQuotes = ['words' => ['quote 1', 'quote 2']];
    \Illuminate\Support\Facades\Cache::put('5-quotes', $oldQuotes);

    $this->getJsonAuthenticated('api/quotes/refresh')
        ->assertJson(fn(AssertableJson $json) =>
        $json->has('quotes', 5)
            ->missing('words')
        );
});

function fakeQuotes()
{
    \Illuminate\Support\Facades\Http::fake([
        'https://api.kanye.rest/' => Http::sequence()
            ->push(['quote' => 'Quote 1'])
            ->push(['quote' => 'Quote 2'])
            ->push(['quote' => 'Quote 3'])
            ->push(['quote' => 'Quote 4'])
            ->push(['quote' => 'Quote 5'])
            ->whenEmpty(Http::response()),
    ]);
}
