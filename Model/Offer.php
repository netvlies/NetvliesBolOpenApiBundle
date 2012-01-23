<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Model;

use Netvlies\Bundle\BolOpenApiBundle\Model\Seller;

class Offer
{
    protected $id;
    protected $firstEdition;
    protected $specialEdition;
    protected $state;
    protected $price;
    protected $listPrice;
    protected $availabilityCode;
    protected $availabilityDescription;
    protected $comment;
    protected $secondHand;
    protected $seller;

    /**
     * @param $availabilityCode
     */
    public function setAvailabilityCode($availabilityCode)
    {
        $this->availabilityCode = $availabilityCode;
    }

    /**
     * @return string
     */
    public function getAvailabilityCode()
    {
        return $this->availabilityCode;
    }

    /**
     * @param $availabilityDescription
     */
    public function setAvailabilityDescription($availabilityDescription)
    {
        $this->availabilityDescription = $availabilityDescription;
    }

    /**
     * @return string
     */
    public function getAvailabilityDescription()
    {
        return $this->availabilityDescription;
    }

    /**
     * @param $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param $firstEdition
     */
    public function setFirstEdition($firstEdition)
    {
        $this->firstEdition = $firstEdition;
    }

    /**
     * @return bool
     */
    public function getFirstEdition()
    {
        return $this->firstEdition;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $listPrice
     */
    public function setListPrice($listPrice)
    {
        $this->listPrice = $listPrice;
    }

    /**
     * @return float
     */
    public function getListPrice()
    {
        return $this->listPrice;
    }

    /**
     * @param $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $secondHand
     */
    public function setSecondHand($secondHand)
    {
        $this->secondHand = $secondHand;
    }

    /**
     * @return bool
     */
    public function getSecondHand()
    {
        return $this->secondHand;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\Seller $seller
     */
    public function setSeller(Seller $seller)
    {
        $this->seller = $seller;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\Seller
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param $specialEdition
     */
    public function setSpecialEdition($specialEdition)
    {
        $this->specialEdition = $specialEdition;
    }

    /**
     * @return bool
     */
    public function getSpecialEdition()
    {
        return $this->specialEdition;
    }

    /**
     * @param $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        $this->setId((string) $xmlElement->Id);
        $this->setFirstEdition((string) $xmlElement->FirstEdition);
        $this->setSpecialEdition((string) $xmlElement->SpecialEdition);
        $this->setState((string) $xmlElement->State);
        $this->setPrice((string) $xmlElement->Price);
        $this->setListPrice((string) $xmlElement->ListPrice);
        $this->setAvailabilityCode((string) $xmlElement->AvailabilityCode);
        $this->setAvailabilityDescription((string) $xmlElement->AvailabilityDescription);
        $this->setComment((string) $xmlElement->Comment);
        $this->setSecondHand((string) $xmlElement->SecondHand);

        $seller = new Seller();
        $seller->fromXml($xmlElement->Seller);
        $this->setSeller($seller);    
    }
}