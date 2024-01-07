<?php

namespace App\Interfaces;

interface QuoteApiDriver
{
    public function quote(): string|null;
}
