<?php

namespace App\Services;

use GuzzleHttp\Client;

class GoogleDistanceMatrixService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('GOOGLE_API_KEY');
    }

    public function getDistanceMatrix($origins, $destinations)
    {
        $response = $this->client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'query' => [
                'origins' => implode('|', $origins),
                'destinations' => implode('|', $destinations),
                'key' => $this->apiKey,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
