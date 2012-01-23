<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Response;

use Netvlies\Bundle\BolOpenApiBundle\Model\Product;

class ProductResponse
{
    protected $sessionId;
    protected $product;

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
     * @param string $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
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