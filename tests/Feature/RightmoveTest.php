<?php

namespace Tests\Feature;

use App\Services\Craweler\Rightmove;
use Tests\TestCase;

class RightmoveTest extends TestCase
{
    public function testNumberOfPropertiesSold()
    {
        $properties = (new Rightmove('CR0'))->handle();

        $this->assertSame(35509, $properties['number_of_sold_properties']);
    }

    public function testItReturnsFiveMostExpensiveSoldInTheLastTenYears()
    {
        $properties = (new Rightmove('CR0'))->handle();
        $properties->forget('number_of_sold_properties');

        $this->assertSame($this->data(), $properties->toArray());
    }

    public function testIncorrectPostcode()
    {
        $properties = (new Rightmove('afsed'))->handle();

        $this->assertSame(0, $properties['number_of_sold_properties']);

        $properties->forget('number_of_sold_properties');

        $this->assertSame(0, $properties->count());
    }

    public function testReturnsPropertiesOnlySoldTenYearsAgo()
    {
        $properties = (new Rightmove('CR9'))->handle();

        $this->assertSame(2, $properties['number_of_sold_properties']);

        $properties->forget('number_of_sold_properties');

        $this->assertSame(0, $properties->count());
    }

    protected function data(): array
    {
        return [
            [
                "address" => "31c, Woodmere Avenue, Croydon, Greater London CR0 7PG",
                "propertyType" => "Detached",
                "price" => "600000",
            ],
            [
                "address" => "51, Bennetts Way, Croydon, Greater London CR0 8AE",
                "propertyType" => "Terraced",
                "price" => "586251",
            ],
            [
                "address" => "10, Glenthorne Avenue, Croydon, Greater London CR0 7EY",
                "propertyType" => "Terraced",
                "price" => "550000",
            ],
            [
                "address" => "22, Brockenhurst Road, Croydon, Greater London CR0 7DR",
                "propertyType" => "Terraced",
                "price" => "520000",
            ],
            [
                "address" => "78a, Coniston Road, Croydon, Greater London CR0 6LN",
                "propertyType" => "Terraced",
                "price" => "520000",
            ]
        ];
    }
}
