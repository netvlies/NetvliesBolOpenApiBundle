<?php
/*
 * This file is part of the NetvliesBolOpenApiBundle.
 *
 * (c) Netvlies Internetdiensten
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Netvlies\Bundle\BolOpenApiBundle\Factory;

use Netvlies\Bundle\BolOpenApiBundle\Response\AbstractCollectionResponse;
use Netvlies\Bundle\BolOpenApiBundle\Response\ListResultsResponse;
use Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse;
use Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse;

class ResponseFactory
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Factory\ModelFactory
     */
    protected $modelFactory;

    public function __construct()
    {
        $this->modelFactory = new ModelFactory();
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     * @return \Netvlies\Bundle\BolOpenApiBundle\Response\ListResultsResponse
     */
    public function createListResultsResponse(\SimpleXMLElement $xmlElement)
    {
        $listResultsResponse = new ListResultsResponse();
        $this->mapAbstractCollectionResponse($listResultsResponse, $xmlElement);

        return $listResultsResponse;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     * @return \Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse
     */
    public function createSearchResultsResponse(\SimpleXMLElement $xmlElement)
    {
        $searchResultsResponse = new SearchResultsResponse();
        $this->mapAbstractCollectionResponse($searchResultsResponse, $xmlElement);

        return $searchResultsResponse;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     * @return \Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse
     */
    public function createProductResponse(\SimpleXMLElement $xmlElement)
    {
        $productResponse = new ProductResponse();
        $productResponse->setSessionId((string) $xmlElement->SessionId);
        $productResponse->setProduct($this->modelFactory->createProduct($xmlElement->Product));

        return $productResponse;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Response\AbstractCollectionResponse $abstractCollectionResponse
     * @param \SimpleXMLElement $xmlElement
     */
    protected function mapAbstractCollectionResponse(AbstractCollectionResponse $abstractCollectionResponse, \SimpleXMLElement $xmlElement)
    {
        foreach ($xmlElement->children() as $child) {
            if($child->getName() == 'Product') {
                $abstractCollectionResponse->addProduct($this->modelFactory->createProduct($child));
            } elseif($child->getName() == 'Category') {
                $abstractCollectionResponse->addCategory($this->modelFactory->createCategory($child));
            } elseif($child->getName() == 'RefinementGroup') {
                $abstractCollectionResponse->addRefinementGroup($this->modelFactory->createRefinementGroup($child));
            } elseif($child->getName() == 'OriginalRequest') {
                $abstractCollectionResponse->setOriginalRequest($this->modelFactory->createOriginalRequest($child));
            } elseif($child->getName() == 'SessionId') {
                $abstractCollectionResponse->setSessionId((string) $xmlElement->SessionId);
            } elseif($child->getName() == 'TotalResultSize') {
                $abstractCollectionResponse->setTotalResultSize((string) $xmlElement->TotalResultSize);
            }
        }
    }
}