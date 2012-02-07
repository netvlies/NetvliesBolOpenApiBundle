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
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/product_response.xml', 0 , true);
        $this->productResponse = new ProductResponse($simpleXmlElement);
    }

    public function testIsProductResponse()
    {
        $this->assertTrue($this->productResponse instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse);
    }

    public function testIsValid()
    {
        $this->assertTrue($this->productResponse->getProduct() instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Product);
        $this->assertEquals($this->productResponse->getProduct()->getId(), '1001004006016448');
        $this->assertEquals($this->productResponse->getSessionId(), '492616E7-4B57-42A8-A688-28DD6943AE4E');
    }
}