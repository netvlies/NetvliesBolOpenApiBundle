<?php
/*
 * This file is part of the NetvliesBolOpenApiBundle.
 *
 * (c) Netvlies Internetdiensten
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Netvlies\Bundle\BolOpenApiBundle\Model;

use Netvlies\Bundle\BolOpenApi\Bundle\CategoryRefinement;

// @todo categoryRefinement aren't mappend
// @todo productCount misses in Documentation
class Category
{
    protected $id;
    protected $name;
    protected $categoryRefinements;
    protected $productCount;

    public function __construct(\SimpleXMLElement $xmlElement)
    {
        $this->fromXml($xmlElement);
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApi\Bundle\CategoryRefinement $categoryRefinement
     */
    public function addCategoryRefinements(CategoryRefinement $categoryRefinement)
    {
        $this->categoryRefinements[] = $categoryRefinement;
    }

    /**
     * @param array $categoryRefinements
     */
    public function setCategoryRefinements($categoryRefinements)
    {
        $this->categoryRefinements = $categoryRefinements;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApi\Bundle\CategoryRefinement[]
     */
    public function getCategoryRefinements()
    {
        return $this->categoryRefinements;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $productCount
     */
    public function setProductCount($productCount)
    {
        $this->productCount = $productCount;
    }

    /**
     * @return int
     */
    public function getProductCount()
    {
        return $this->productCount;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        $this->setId((string) $xmlElement->Id);
        $this->setName((string) $xmlElement->Name);
        $this->setProductCount((string) $xmlElement->ProductCount);
    }
}