<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\Model;

use Netvlies\Bundle\BolOpenApiBundle\Model\OfferTotals;

class OfferTotalsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Model\OfferTotals
     */
    private $offerTotals;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/offer_totals.xml', 0 , true);
        $this->offerTotals = new OfferTotals($simpleXmlElement);
    }

    public function testIsOfferTotals()
    {
        $this->assertTrue($this->offerTotals instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\OfferTotals);
    }

    public function testIsValid()
    {
        $this->assertEquals(1, $this->offerTotals->getBolCom());
        $this->assertEquals(0, $this->offerTotals->getPlaza());
        $this->assertEquals(0, $this->offerTotals->getSecondHand());
    }
}