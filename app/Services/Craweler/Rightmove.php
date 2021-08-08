<?php

namespace App\Services\Craweler;

use Str;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Collection;

class Rightmove extends BaseCrawler
{
    /**
     * @param  Collection $responseData
     * @return Collection
     */
    public function properties(Collection $responseData): Collection
    {
        $properties = collect();
        $tenYearsAgo = strtotime("-10 years");

        foreach ($responseData as $property) {
            $data = [
                'address' => $property->address,
                'propertyType' => $property->propertyType,
            ];

            if (!empty($property->transactions)) {
                foreach ($property->transactions as $transaction) {
                    $dateSold = strtotime($transaction->dateSold);
                    $price = Str::replace(['&pound;', ','], '', $transaction->displayPrice);

                    if ($dateSold >= $tenYearsAgo) {
                        $data['price'] = $price;
                        $properties->push($data);
                    }
                }
            }
        }

        return $properties->sortByDesc('price')->take(5);
    }

    /**
     * @param  Crawler $crawler
     * @return Collection
     */
    protected function numberOfSoldProperties(Crawler $crawler): Collection
    {
        $number = (int) Str::of($crawler->text())
            ->after('resultCount":"')
            ->before('","')
            ->replace(',', '')
            ->__toString();

        return collect([ 'number_of_sold_properties' => $number ]);
    }
}
