<?php

/*
 * This file is part of the NetvliesBolOpenApiBundle.
 *
 * (c) Netvlies Internetdiensten
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Netvlies\Bundle\BolOpenApiBundle\Tests\DependencyInjection;

use Netvlies\Bundle\BolOpenApiBundle\DependencyInjection\NetvliesBolOpenApiExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;

class NetvliesBolOpenApiExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testDefault()
    {
        $container = new ContainerBuilder();
        $loader = new NetvliesBolOpenApiExtension();
        $loader->load(array(), $container);
        $this->assertTrue($container->hasDefinition('netvlies_bol_open_api.api'));
        $this->assertTrue($container->hasDefinition('netvlies_bol_open_api.buzz_browser'));
        $this->assertFalse($container->hasDefinition('netvlies_bol_open_api.api.access_key'));
        $this->assertFalse($container->hasDefinition('netvlies_bol_open_api.api.secret_access_key'));
    }

    public function testKeys()
    {
        $container = new ContainerBuilder();
        $loader = new NetvliesBolOpenApiExtension();
        $loader->load(array(array('access_key' => 'foo', 'secret_access_key' => 'bar')), $container);
        $this->assertEquals($container->getParameter('netvlies_bol_open_api.api.access_key'), 'foo');
        $this->assertEquals($container->getParameter('netvlies_bol_open_api.api.secret_access_key'), 'bar');
    }
}
