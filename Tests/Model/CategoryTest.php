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

use Netvlies\Bundle\BolOpenApiBundle\Model\Category;

class CategoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Model\Category
     */
    private $category;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/category.xml', 0 , true);
        $this->category = new Category($simpleXmlElement);
    }

    public function testIsCategory()
    {
        $this->assertTrue($this->category instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Category);
    }

    public function testIsValid()
    {
        $this->assertEquals($this->category->getId(), 10463);
        $this->assertEquals($this->category->getName(), 'LEGO');
        $this->assertEquals($this->category->getProductCount(), 261);
    }

    public function testRefinements()
    {
        // @todo test refinements
    }
}