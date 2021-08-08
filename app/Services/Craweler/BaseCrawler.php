<?php

namespace App\Services\Craweler;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Str;
use Illuminate\Support\Collection;

abstract class BaseCrawler implements CrawelerInterface
{
    /**
     * @var string
     */
    protected $postcode;

    /**
     * @param string $postcode
     */
    public function __construct(string $postcode)
    {
        $this->postcode = $postcode;
        $this->client = new Client;
    }

    /**
     * @return Collection
     */
    public function handle(): Collection
    {
        $crawler = $this->submitForm();
        $responseData = $this->filterResults($crawler);

        return $this->properties($responseData)
            ->merge($this->numberOfSoldProperties($crawler));
    }

    /**
     * @return Crawler
     */
    public function submitForm(): Crawler
    {
        $crawler = $this->client->request('GET', config('services.rightmove.url'));

        $form = $crawler->selectButton('List View')->form();

        return $this->client->submit(
            $form,
            [
                'searchLocation' => $this->postcode
            ]
        );
    }

    /**
     * @param  Crawler $crawler
     * @return Collection
     */
    public function filterResults(Crawler $crawler): Collection
    {
        $jsonResults = Str::of($crawler->text())->after('"properties":')
            ->before('"}]')
            ->__toString();

        $properties = json_decode($jsonResults . '"}]');

        return collect($properties);
    }
}
