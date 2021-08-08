<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\ShowRequest;
use App\Services\Craweler\Rightmove;

/**
 * Class WebCrawlerController
 *
 * @package App\Http\Controllers
 */
class WebCrawlerController extends Controller
{
    /**
     * @param  ShowRequest $request
     * @return View
     */
    public function show(ShowRequest $request)
    {
        return view('webcrawler/show');
    }

    /**
     * @param  SearchRequest $request
     * @return View
     */
    public function search(SearchRequest $request)
    {
        $properties = (new Rightmove($request->postcode))->handle();
        $sold_properties = $properties['number_of_sold_properties'];

        $properties->forget('number_of_sold_properties');

        return view('webcrawler/search', compact('properties', 'sold_properties'));
    }
}
