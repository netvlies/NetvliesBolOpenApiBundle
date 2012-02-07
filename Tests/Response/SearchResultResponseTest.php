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

use Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse;

class SearchResultsResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse
     */
    private $searchResultsResponse;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/search_results_response.xml', 0 , true);
        $this->searchResultsResponse = new SearchResultsResponse($simpleXmlElement);
    }

    public function testIsSearchResultsResponse()
    {
        $this->assertTrue($this->searchResultsResponse instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse);
    }

    public function testIsValid()
    {
        $this->assertTrue(count($this->searchResultsResponse->getCategories()) === 3);
        $this->assertTrue(array_shift($this->searchResultsResponse->getCategories()) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Category);
        $this->assertTrue($this->searchResultsResponse->getOriginalRequest() instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest);
        $this->assertTrue(count($this->searchResultsResponse->getProducts()) === 5);
        $this->assertTrue(array_shift($this->searchResultsResponse->getProducts()) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Product);
        $this->assertTrue(count($this->searchResultsResponse->getRefinementGroups()) === 4);
        $this->assertTrue(array_shift($this->searchResultsResponse->getRefinementGroups()) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup);
        $this->assertEquals($this->searchResultsResponse->getTotalResultSize(), 113);
        $this->assertEquals($this->searchResultsResponse->getSessionId(), '0DD6ACF0-780A-4F05-84A7-076F5C689BC2');
    }
}