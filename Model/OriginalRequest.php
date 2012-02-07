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

use Netvlies\Bundle\BolOpenApiBundle\Model\Category;
use Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup;

class OriginalRequest
{
    protected $category;
    protected $refinementGroups;

    public function __construct(\SimpleXMLElement $xmlElement)
    {
        $this->fromXml($xmlElement);
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup $refinementGroup
     */
    public function addRefinementGroups(RefinementGroup $refinementGroup)
    {
        $this->refinementGroups[] = $refinementGroup;
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\RefinementGroup $refinementGroups
     */
    public function setRefinementGroups($refinementGroups)
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
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        foreach ($xmlElement->children() as $child) {
            if($child->getName() == 'Category') {
                $category = new Category($child);
                $this->setCategory($category);
            } elseif($child->getName() == 'RefinementGroup') {
                $refinementGroup = new RefinementGroup($child);
                $this->addRefinementGroups($refinementGroup);
            }
        }
    }
}