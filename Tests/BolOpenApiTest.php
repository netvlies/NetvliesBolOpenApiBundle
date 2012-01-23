<?php
use Netvlies\Bundle\BolOpenApiBundle\BolOpenApi;
use Buzz\Browser;

// @todo test live and mock
// @todo model tests
class BolOpenApiTest extends \PHPUnit_Framework_TestCase
{

    public function testInvalidAccessKeys()
    {
    }

    public function testValidAccessKeys()
    {
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testProductsIntegerOverflow()
    {
        $api = $this->getApiWithInvalidKeys();
        $api->products(100000000000000000000);
    }

    public function testGetSignature()
    {
        $this->assertTrue(true);
    }

    public function getApiWithInvalidKeys()
    {
        return new BolOpenApi('a', 'b', new Browser());
    }

}