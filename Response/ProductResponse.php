<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Response;

use Netvlies\Bundle\BolOpenApiBundle\Model\Product;

class ProductResponse extends AbstractResponse
{
    protected $product;

    public function __construct(\SimpleXMLElement $xmlElement)
    {
        $this->fromXml($xmlElement);
    }

    /**
     * @param \Netvlies\Bundle\BolOpenApiBundle\Model\Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return \Netvlies\Bundle\BolOpenApiBundle\Model\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function fromXml(\SimpleXMLElement $xmlElement)
    {
        $this->setSessionId((string) $xmlElement->SessionId);
        $product = new Product();
        $product->fromXml($xmlElement->Product);
        $this->setProduct($product);
    }
}