<?php
/*
 * This file is part of the NetvliesBolOpenApiBundle.
 *
 * (c) Netvlies Internetdiensten
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Netvlies\Bundle\BolOpenApiBundle\Model;

use Netvlies\Bundle\BolOpenApiBundle\Model\Offer;
use Netvlies\Bundle\BolOpenApiBundle\Model\OfferTotals;

class Offers
{
    protected $offers;
    protected $offerTotals;

    public function __construct(\SimpleXMLElement $xmlElement)
    {
        $this->fromXml($xmlElement);
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
                $offer = new Offer($child);
                $this->addOffer($offer);
            }
            if ($child->getName() == 'OfferTotals') {
                $offerTotals = new OfferTotals($child);
                $this->setOfferTotals($offerTotals);
            }
        }
    }
}