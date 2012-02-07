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

}