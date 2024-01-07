<?php

namespace App\Http\Controllers;

use App\Services\Quotes\QuotesManager;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class QuotesController extends Controller
{
    public function quotes(QuotesManager $quotesManager)
    {
        $quotes = Cache::remember('5-quotes', now()->addMinutes(5), function () use ($quotesManager) {
            return $this->getQuotes($quotesManager);
        });

        return response()->json(['quotes' => $quotes]);
    }

    public function refreshQuotes(QuotesManager $quotesManager)
    {
        $newQuotes = $this->getQuotes($quotesManager);
        Cache::put('5-quotes', $newQuotes, now()->addMinutes(5));
        return response()->json(['quotes' => $newQuotes]);
    }

    private function getQuotes(QuotesManager $quotesManager): Collection
    {
        $quotes = collect();

        for ($x = 0; $x <= 4; $x++) {
            $quotes->push($quotesManager->quote());
        }

        return $quotes;
    }
}
