<?php
namespace Hidehalo\Util\Generator\Test;

use Hidehalo\Util\Generator\SingletonTrait;
use PHPUnit\Framework\TestCase;

class SingletonStub
{
    use SingletonTrait;
}

class SingletonTraitTest extends TestCase
{
    public function testConstructAndSingleton()
    {
        $newInstance = new SingletonStub();
        $singleton = $newInstance::singleton();
        $this->assertNotSame($newInstance, $singleton);

        $sameAsSingleton = $singleton::singleton();
        $this->assertSame($singleton, $sameAsSingleton);
    }
}
