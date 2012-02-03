<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\Model;

use Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse;

class ProductResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse
     */
    private $productResponse;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/offers.xml', 0 , true);
        $this->productResponse = new ProductResponse($simpleXmlElement);
    }

    public function testIsProductResponse()
    {
        $this->assertTrue($this->productResponse instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse);
    }

}