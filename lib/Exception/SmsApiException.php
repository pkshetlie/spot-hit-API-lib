<?php

namespace SpotHit\Client\Exception;

class SmsApiException extends MessageException
{
    const TYPE = self::TYPE_SMS;
}