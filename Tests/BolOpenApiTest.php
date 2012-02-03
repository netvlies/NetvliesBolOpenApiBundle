<?php
namespace Netvlies\Bundle\BolOpenApiBundle\Tests;

use Netvlies\Bundle\BolOpenApiBundle\BolOpenApi;
use Netvlies\Bundle\BolOpenApiBundle\Exception as BolException;
use Buzz\Browser;

// @todo test live and mock
// @todo model tests
class BolOpenApiTest extends \PHPUnit_Framework_TestCase
{
    private $bolApi;

    public function setUp()
    {
        // bol sample data, do not use in your own application. Request your own keys: https://developers.bol.com/inloggen/?action=register
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
}