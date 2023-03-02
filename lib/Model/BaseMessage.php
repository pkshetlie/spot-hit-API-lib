<?php

namespace SpotHit\Client\Model;

abstract class BaseMessage
{
    protected $key;

    /**
     * @return mixed
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }


}