<?php

namespace SpotHit\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class SpotHit
{
    protected string $base_url = "https://www.spot-hit.fr/api/";
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct()
    {
        $this->client = new Client();
    }

}