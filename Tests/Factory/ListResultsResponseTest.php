<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\Model;

use Netvlies\Bundle\BolOpenApiBundle\Factory\ResponseFactory;

class ListResultsResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Response\ListResultsResponse
     */
    private $listResultsResponse;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/list_results_response.xml', 0 , true);
        $factory = new ResponseFactory();
        $this->listResultsResponse = $factory->createListResultsResponse($simpleXmlElement);
    }

    public function testIsListResultsResponse()
    {
        $this->assertTrue($this->listResultsResponse instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\ListResultsResponse);
    }

    public function testIsValid()
    {
        $categories = $this->listResultsResponse->getCategories();
        $products = $this->listResultsResponse->getProducts();
        $refinementGroups = $this->listResultsResponse->getRefinementGroups();

        $this->assertTrue(count($categories) === 8);
        $this->assertTrue(array_shift($categories) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Category);
        $this->assertTrue($this->listResultsResponse->getOriginalRequest() instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest);
        $this->assertTrue(count($products) === 5);
        $this->assertTrue(array_shift($products) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Product);
        $this->assertTrue(count($refinementGroups) === 16);
        $this->assertTrue(array_shift($refinementGroups) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup);
        $this->assertEquals($this->listResultsResponse->getTotalResultSize(), 283);
        $this->assertEquals($this->listResultsResponse->getSessionId(), '800858D7-61A8-40DD-B05D-63BB05DDA248');
    }
}