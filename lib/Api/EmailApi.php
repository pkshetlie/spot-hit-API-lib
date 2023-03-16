<?php

namespace SpotHit\Client\Api;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use SpotHit\Client\Exception\EmailApiException;
use SpotHit\Client\Model\SmsMessage;
use SpotHit\Client\SpotHit;

class EmailApi extends SpotHit
{
    /**
     * @throws GuzzleException
     * @throws EmailApiException
     */
    public function envoyer(EmailMessage $message): ?int
    {
        $url = $this->base_url . 'envoyer/sms';
        $response = $this->client->request('POST', $url, ['form_params' => $message->toArray()]);
        $this->checkResponse($response);
        return  json_decode($response->getBody()->getContents())->id;
    }

    protected function checkResponse(ResponseInterface $response): ?int
    {
        if ($error = parent::checkResponse($response)) {
            throw new EmailApiException($error);
        }

        return null;
    }
}