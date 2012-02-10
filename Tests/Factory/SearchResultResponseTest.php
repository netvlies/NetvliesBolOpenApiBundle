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

use Netvlies\Bundle\BolOpenApiBundle\Factory\ResponseFactory;

class SearchResultsResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse
     */
    private $searchResultsResponse;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/search_results_response.xml', 0 , true);
        $factory = new ResponseFactory();
        $this->searchResultsResponse = $factory->createSearchResultsResponse($simpleXmlElement);
    }

    public function testIsSearchResultsResponse()
    {
        $this->assertTrue($this->searchResultsResponse instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse);
    }

    public function testIsValid()
    {
        $categories = $this->searchResultsResponse->getCategories();
        $products = $this->searchResultsResponse->getProducts();
        $refinementGroups = $this->searchResultsResponse->getRefinementGroups();

        $this->assertTrue(count($categories) === 3);
        $this->assertTrue(array_shift($categories) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Category);
        $this->assertTrue($this->searchResultsResponse->getOriginalRequest() instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest);
        $this->assertTrue(count($products) === 5);
        $this->assertTrue(array_shift($products) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Product);
        $this->assertTrue(count($refinementGroups) === 4);
        $this->assertTrue(array_shift($refinementGroups) instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup);
        $this->assertEquals($this->searchResultsResponse->getTotalResultSize(), 113);
        $this->assertEquals($this->searchResultsResponse->getSessionId(), '0DD6ACF0-780A-4F05-84A7-076F5C689BC2');
    }
}