<?php
/*
 * This file is part of the NetvliesBolOpenApiBundle.
 *
 * (c) Netvlies Internetdiensten
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require 'vendor/.composer/autoload.php';

spl_autoload_register(function($class) {
    $class = ltrim($class, '\\');
    if (0 === strpos($class, 'Netvlies\Bundle\BolOpenApiBundle\\')) {
        $file = __DIR__.'/../'.str_replace('\\', '/', substr($class, strlen('Netvlies\Bundle\BolOpenApiBundle\\'))).'.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});