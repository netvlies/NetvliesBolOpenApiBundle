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
}