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

use Netvlies\Bundle\BolOpenApiBundle\Model\Product;

class ProductResponse extends AbstractResponse
{
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
}