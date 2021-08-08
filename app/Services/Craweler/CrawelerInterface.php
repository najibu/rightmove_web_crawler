<?php

namespace App\Services\Craweler;

use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Collection;

interface CrawelerInterface
{
    /**
     * @return Crawler
     */
    public function submitForm(): Crawler;

    /**
     * @param  Crawler $crawler
     * @return Collection
     */
    public function filterResults(Crawler $crawler): Collection;

    /**
     * @param  Collection $responseData
     * @return Collection
     */
    public function properties(Collection $responseData): Collection;
}
