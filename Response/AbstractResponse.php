<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Response;

abstract class AbstractResponse
{
    private $sessionId;

    /**
     * @param string $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }
}