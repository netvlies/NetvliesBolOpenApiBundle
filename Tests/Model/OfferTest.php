<?php
/*
 * This file is part of the NetvliesBolOpenApiBundle.
 *
 * (c) Netvlies Internetdiensten
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\Model;

use Netvlies\Bundle\BolOpenApiBundle\Model\Offer;

class OfferTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Model\Offer
     */
    private $offer;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/offer.xml', 0 , true);
        $this->offer = new Offer($simpleXmlElement);
    }

    public function testIsOffer()
    {
        $this->assertTrue($this->offer instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Offer);
    }

    public function testIsValid()
    {
        $this->assertEquals($this->offer->getId(), 1004004007093471);
        $this->assertEquals($this->offer->getState(), 'Nieuw');
        $this->assertEquals($this->offer->getPrice(), 49.99);
        $this->assertEquals($this->offer->getAvailabilityCode(), 170);
        $this->assertEquals($this->offer->getAvailabilityDescription(), 'Vandaag voor 22.30 uur besteld, morgen in huis.');
    }

    public function testSeller()
    {
        $this->assertTrue($this->offer->getSeller() instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Seller);
    }
}