<?php

it('returns a new kanye rest quote', function () {
    \Illuminate\Support\Facades\Http::fake([
        'https://api.kanye.rest/' => \Illuminate\Support\Facades\Http::response(['quote' => 'A new quote']),
    ]);

    $quote = app(\App\Services\Quotes\QuotesManager::class)->quote();

    expect($quote)->toBe('A new quote');
});

it('returns null if the kayne rest quote fails', function () {
    \Illuminate\Support\Facades\Http::fake([
        'https://api.kanye.rest/' => \Illuminate\Support\Facades\Http::response([], 500),
    ]);

    $quote = app(\App\Services\Quotes\QuotesManager::class)->quote();

    expect($quote)->toBeNull();
});
