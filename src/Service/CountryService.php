<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class CountryService 
{
    protected $client;
    public function __construct() {
        $this->client = HttpClient::create()->withOptions([
            "base_uri"=>"https://restcountries.com/v3.1/"
        ]);
    }

    public function fetchCountries()
    {
        $response = $this->client->request("GET","all");
        return $response->toArray();
    }
}
