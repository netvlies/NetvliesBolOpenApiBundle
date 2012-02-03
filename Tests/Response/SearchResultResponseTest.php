<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\Model;

use Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse;

class SearchResultsResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse
     */
    private $searchResultsResponse;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/offers.xml', 0 , true);
        $this->searchResultsResponse = new SearchResultsResponse($simpleXmlElement);
    }

    public function testIsSearchResultsResponse()
    {
        $this->assertTrue($this->searchResultsResponse instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse);
    }

}