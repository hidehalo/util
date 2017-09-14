<?php
namespace Hidehalo\Util\Generator\Test;

use Hidehalo\Util\Generator\SingletonTrait;
use PHPUnit\Framework\TestCase;
class SingletonStub { use SingletonTrait; }

class SingletonTraitTest extends TestCase
{

    /**
    * @dataProvider singletonStubProvider
    */
    public function testSingleton(SingletonStub $instance)
    {
        $singleton = $instance::singleton();
        $this->assertSame($instance, $singleton);
    }

    public function singletonStubProvider()
    {
        return [
            [SingletonStub::singleton()]
        ];
    }
}