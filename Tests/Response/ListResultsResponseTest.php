<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\Model;

use Netvlies\Bundle\BolOpenApiBundle\Response\ListResultsResponse;

class ListResultsResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Response\ListResultsResponse
     */
    private $listResultsResponse;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/list_results_response.xml', 0 , true);
        $this->listResultsResponse = new ListResultsResponse($simpleXmlElement);
    }

    public function testIsListResultsResponse()
    {
        $this->assertTrue($this->listResultsResponse instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\ListResultsResponse);
    }

    public function testIsValid()
    {
        $this->assertTrue(count($this->listResultsResponse->getCategories()) === 8);
        $this->assertTrue(array_shift($this->listResultsResponse->getCategories()) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Category);
        $this->assertTrue($this->listResultsResponse->getOriginalRequest() instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest);
        $this->assertTrue(count($this->listResultsResponse->getProducts()) === 5);
        $this->assertTrue(array_shift($this->listResultsResponse->getProducts()) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Product);
        $this->assertTrue(count($this->listResultsResponse->getRefinementGroups()) === 16);
        $this->assertTrue(array_shift($this->listResultsResponse->getRefinementGroups()) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup);
        $this->assertEquals($this->listResultsResponse->getTotalResultSize(), 283);
        $this->assertEquals($this->listResultsResponse->getSessionId(), '800858D7-61A8-40DD-B05D-63BB05DDA248');
    }
}