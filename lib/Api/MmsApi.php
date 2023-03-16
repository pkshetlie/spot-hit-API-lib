<?php

namespace SpotHit\Client\Api;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use SpotHit\Client\Exception\MmsApiException;
use SpotHit\Client\Model\SmsMessage;
use SpotHit\Client\SpotHit;

class MmsApi extends SpotHit
{
    /**
     * @throws GuzzleException
     * @throws MmsApiException
     */
    public function envoyer(MmsMessage $message): ?int
    {
        $url = $this->base_url . 'envoyer/sms';
        $response = $this->client->request('POST', $url, ['form_params' => $message->toArray()]);
        $this->checkResponse($response);
        return  json_decode($response->getBody()->getContents())->id;
    }

    protected function checkResponse(ResponseInterface $response): ?int
    {
        if ($error = parent::checkResponse($response)) {
            throw new MmsApiException($error);
        }

        return null;
    }
}