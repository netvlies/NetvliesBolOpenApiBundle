<?php

namespace Netvlies\Bundle\BolOpenApiBundle\Tests;

use Netvlies\Bundle\BolOpenApiBundle\BolOpenApi;
use Netvlies\Bundle\BolOpenApiBundle\Exception as BolException;
use Buzz\Browser;

class BolOpenApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Netvlies\Bundle\BolOpenApiBundle\BolOpenApi
     */
    private $bolApi;

    public function setUp()
    {
        // bol.com sample data, do not use in your own application. Request your own keys: https://developers.bolCom.com/inloggen/?action=register
        $this->bolApi = new BolOpenApi('B19C17EF61514343B1780F0C520E260B', 'EADBE4CDF75C8F5C6E69246806BB6255B23F4C0206EEFE370A6AE92BBDD42C3E11627F23825935DEBC65F25A1B782F20E6B735C020A9B5CDA81A398BAB80C3D3A91CE3CDEECFCA28A867C0CA45F78201FE8B5C45BC88F37A7737AC2CEC105B3A6A44DD54CD22FF0BC5C29E140ADD4A41F6CED232C9BDF02C744BEE863CAE74FE', new \Buzz\Browser());
    }

    public function testProductsIntegerOverflow()
    {
        $this->setExpectedException(
            'InvalidArgumentException', 'integer overflow', 0
        );
        $this->bolApi->products(10000000000000000000000000000000000);
    }

    public function testApiWithInvalidKeys()
    {
        $this->setExpectedException(
            'Netvlies\Bundle\BolOpenApiBundle\Exception', 'InvalidAccessKeyId', 403
        );
        $invalidBolApi = new BolOpenApi('a', 'b', new Browser());
        $invalidBolApi->products('1');
    }

    public function testInvalidProduct()
    {
        $this->setExpectedException(
            'Netvlies\Bundle\BolOpenApiBundle\Exception', 'UnknownProduct', 404
        );
        $this->bolApi->products('1');
    }

    public function testValidProduct()
    {
        $productResponse = $this->bolApi->products('1001004011586273');
        $this->assertTrue($productResponse instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\ProductResponse);
    }

    public function testInvalidSearchResults()
    {
        $this->setExpectedException(
            'Netvlies\Bundle\BolOpenApiBundle\Exception', 'SearchResultsEmpty', 404
        );
        $this->bolApi->searchResults('nsjkabfisdaufbsdiuabfsdi8fhsiduahf98sdayfisdhafhsdail');
    }

    public function testValidSearchResults()
    {
        $searchResults = $this->bolApi->searchResults('php');
        $this->assertTrue($searchResults instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\SearchResultsResponse);
    }

    public function testInvalidListResults()
    {
        $this->setExpectedException(
            'Netvlies\Bundle\BolOpenApiBundle\Exception', 'InvalidRequest', 400
        );
        $this->bolApi->listResults('nsjkabfisdaufbsdiuabfsdi8fhsiduahf98sdayfisdhafhsdail', '789456123aaaaaaa');
    }

    public function testInvalidXmlListResults()
    {
        $this->setExpectedException(
            'Netvlies\Bundle\BolOpenApiBundle\Exception', 'Error parsing the xml as SimpleXMLElement'
        );
        $this->bolApi->listResults('', '');
    }

    public function testValidListResults()
    {
        $listResults = $this->bolApi->listResults('toplist_default', '10462');
        $this->assertTrue($listResults instanceof \Netvlies\Bundle\BolOpenApiBundle\Response\ListResultsResponse);
    }
}