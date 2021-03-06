<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZFTest\Apigility;

use PHPUnit\Framework\TestCase;
use ZF\Apigility\Autoloader;

class AutoloaderTest extends TestCase
{
    public function classesToAutoload()
    {
        return [
            'Foo_Bar'         => ['ZFTest\Apigility\TestAsset\Foo_Bar'],
            'Foo_Bar\Baz_Bat' => ['ZFTest\Apigility\TestAsset\Foo_Bar\Baz_Bat'],
        ];
    }

    /**
     * @dataProvider classesToAutoload
     */
    public function testAutoloaderDoesNotTransformUnderscoresToDirectorySeparators($className)
    {
        $autoloader = new Autoloader([
            'namespaces' => [
                'ZFTest\Apigility\TestAsset' => __DIR__ . '/TestAsset',
            ],
        ]);
        $result = $autoloader->autoload($className);
        $this->assertFalse(false === $result);
        $this->assertTrue(class_exists($className, false));
    }
}
