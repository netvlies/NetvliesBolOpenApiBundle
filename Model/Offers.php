<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Model;

use Netvlies\Bundle\BolOpenApiBundle\Model\Offer;
use Netvlies\Bundle\BolOpenApiBundle\Model\OfferTotals;

// @todo strange data structure: product->offers contains 1 Offers object Offers->offers contains multiple Offer objects (copied from bol API structure)
// @todo documentation states that Product->Offers contains Offer but it contains Offers
class Offers
{
    protected $offers;
    protected $offerTotals;

    public function __construct()
    {
        $this->offers = array();
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\Offer $offer
     */
    public function addOffer(Offer $offer)
    {
        $this->offers[] = $offer;
    }

    /**
     * @param array $offers
     */
    public function setOffers(array $offers)
    {
        $this->offers = $offers;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\Offer[]
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\OfferTotals $offerTotals
     */
    public function setOfferTotals(OfferTotals $offerTotals)
    {
        $this->offerTotals = $offerTotals;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\OfferTotals
     */
    public function getOfferTotals()
    {
        return $this->offerTotals;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        foreach ($xmlElement->children() as $child) {
            if ($child->getName() == 'Offer') {
                $offer = new Offer();
                $offer->fromXml($child);

                $this->addOffer($offer);
            }
            if ($child->getName() == 'OfferTotals') {
                $offerTotals = new OfferTotals();
                $offerTotals->fromXml($child);
                $this->setOfferTotals($offerTotals);
            }
        }
    }
}