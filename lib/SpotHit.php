<?php

namespace SpotHit\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use SpotHit\Client\Exception\SmsApiException;

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

    protected function checkResponse(ResponseInterface $response): ?int
    {
        $content = json_decode($response->getBody()->getContents());
        if ((int)$content->resultat === 0) {
            if (is_array($content->erreurs)) {
                return (int)array_pop($content->erreurs);
            }
            return (int)$content->erreurs;
        }
        return null;
    }

}