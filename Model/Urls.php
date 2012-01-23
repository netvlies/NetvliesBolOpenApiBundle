<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Model;

class Urls
{
    protected $main;

    /**
     * @param string $main
     */
    public function setMain($main)
    {
        $this->main = $main;
    }

    /**
     * @return string
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        $this->setMain((string) $xmlElement->Main);
    }
}