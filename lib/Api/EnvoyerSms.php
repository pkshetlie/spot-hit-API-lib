<?php

namespace SpotHit\Client\Api;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use SpotHit\Client\Model\SmsMessage;
use SpotHit\Client\SpotHit;

class EnvoyerSms extends SpotHit
{
    /**
     * @throws GuzzleException
     */
    public function envoyer(SmsMessage $smsMessage): ResponseInterface
    {
        $url = $this->base_url.'envoyer/sms';
        return $this->client->request('POST', $url, ['form_params' => $smsMessage->toArray()]);
    }
}