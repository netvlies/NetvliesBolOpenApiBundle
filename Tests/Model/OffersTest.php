<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\Model;

use Netvlies\Bundle\BolOpenApiBundle\Model\Offers;

class OffersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Model\Offers
     */
    private $offers;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/offers.xml', 0 , true);
        $this->offers = new Offer($simpleXmlElement);
    }

    public function testIsOffers()
    {
        $this->assertTrue($this->offers instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Offers);
    }

    public function testIsValid()
    {
        $this->assertEquals($this->offers->getOfferTotals()->getBol(), 1004004007093471);
        $this->assertEquals($this->offers->getOfferTotals()->getPlaza(), 1004004007093471);
        $this->assertEquals($this->offers->getOfferTotals()->getSecondHand(), 1004004007093471);
    }

    public function testOffers()
    {

    }
}