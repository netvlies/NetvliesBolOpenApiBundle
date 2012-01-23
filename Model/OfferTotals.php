<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Model;

class OfferTotals
{
    protected $bol;
    protected $secondHand;
    protected $plaza;

    /**
     * @param int $bol
     */
    public function setBol($bol)
    {
        $this->bol = $bol;
    }

    /**
     * @return int
     */
    public function getBol()
    {
        return $this->bol;
    }

    /**
     * @param int $plaza
     */
    public function setPlaza($plaza)
    {
        $this->plaza = $plaza;
    }

    /**
     * @return int
     */
    public function getPlaza()
    {
        return $this->plaza;
    }

    /**
     * @param int $secondHand
     */
    public function setSecondHand($secondHand)
    {
        $this->secondHand = $secondHand;
    }

    /**
     * @return int
     */
    public function getSecondHand()
    {
        return $this->secondHand;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        $this->setBol((string) $xmlElement->Bol);
        $this->setPlaza((string) $xmlElement->Plaza);
        $this->setSecondHand((string) $xmlElement->SecondHand);
    }
}