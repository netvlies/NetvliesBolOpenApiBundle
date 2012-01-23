<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Model;

class Refinement
{
    protected $id;
    protected $name;
    protected $productCount;

    /**
     * @param int $id
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
     * @param string $name
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
     * @param int $productCount
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