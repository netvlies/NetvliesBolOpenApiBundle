<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\Model;

use Netvlies\Bundle\BolOpenApiBundle\Model\Images;

class ImagesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\Model\Images
     */
    private $images;

    public function setUp()
    {
        $simpleXmlElement = new \SimpleXMLElement(__DIR__.'/../fixtures/images.xml', 0 , true);
        $this->images = new Images($simpleXmlElement);
    }

    public function testIsImages()
    {
        $this->assertTrue($this->images instanceof \Netvlies\Bundle\BolOpenApiBundle\Model\Images);
    }

    public function testIsValid()
    {
        $this->assertEquals($this->images->getExtraSmall(), 'http://s-s-bol.com/imgbase0/imagebase/mini/FC/1/7/4/3/1004004007093471.jpg');
        $this->assertEquals($this->images->getSmall(), 'http://s-s-bol.com/imgbase0/imagebase/tout/FC/1/7/4/3/1004004007093471.jpg');
        $this->assertEquals($this->images->getMedium(), 'http://s-s-bol.com/imgbase0/imagebase/thumb/FC/1/7/4/3/1004004007093471.jpg');
        $this->assertEquals($this->images->getLarge(), 'http://s-s-bol.com/imgbase0/imagebase/regular/FC/1/7/4/3/1004004007093471.jpg');
        $this->assertEquals($this->images->getExtraLarge(), 'http://s-s-bol.com/imgbase0/imagebase/large/FC/1/7/4/3/1004004007093471.jpg');
    }

}