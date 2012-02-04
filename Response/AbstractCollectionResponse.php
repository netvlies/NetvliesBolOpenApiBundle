<?php
/*
 * This file is part of the NetvliesBolOpenApiBundle.
 *
 * (c) Netvlies Internetdiensten
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Netvlies\Bundle\BolOpenApiBundle\Response;

use Netvlies\Bundle\BolOpenApiBundle\Model\Category;
use Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest;
use Netvlies\Bundle\BolOpenApiBundle\Model\Product;
use Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup;

abstract class AbstractCollectionResponse extends AbstractResponse
{
    protected $products;
    protected $totalResultSize;
    protected $categories;
    protected $refinementGroups;
    protected $originalRequest;

    public function __construct(\SimpleXMLElement $xmlElement)
    {
        $this->fromXml($xmlElement);
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\Category $category
     */
    public function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }

    /**
     * @param array $categories
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest $originalRequest
     */
    public function setOriginalRequest(OriginalRequest $originalRequest)
    {
        $this->originalRequest = $originalRequest;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\OriginalRequest|null
     */
    public function getOriginalRequest()
    {
        return $this->originalRequest;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * @param array $products
     */
    public function setProducts(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup $refinementGroup
     */
    public function addRefinementGroup(RefinementGroup $refinementGroup)
    {
        $this->refinementGroups[] = $refinementGroup;
    }

    /**
     * @param $refinementGroups
     */
    public function setRefinementGroups(array $refinementGroups)
    {
        $this->refinementGroups = $refinementGroups;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup[]
     */
    public function getRefinementGroups()
    {
        return $this->refinementGroups;
    }


    /**
     * @param int $totalResultSize
     */
    public function setTotalResultSize($totalResultSize)
    {
        $this->totalResultSize = $totalResultSize;
    }

    /**
     * @return int
     */
    public function getTotalResultSize()
    {
        return $this->totalResultSize;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        foreach ($xmlElement->children() as $child) {
            if($child->getName() == 'Product') {
                $product = new Product($child);
                $this->addProduct($product);
            } elseif($child->getName() == 'Category') {
                $category = new Category($child);
                $this->addCategory($category);
            } elseif($child->getName() == 'RefinementGroup') {
                $refinementGroup = new RefinementGroup($child);
                $this->addRefinementGroup($refinementGroup);
            } elseif($child->getName() == 'OriginalRequest') {
                $originalRequest = new OriginalRequest($child);
                $this->setOriginalRequest($originalRequest);
            } elseif($child->getName() == 'SessionId') {
                $this->setSessionId((string) $xmlElement->SessionId);
            } elseif($child->getName() == 'TotalResultSize') {
                $this->setTotalResultSize((string) $xmlElement->TotalResultSize);
            }
        }
    }
}