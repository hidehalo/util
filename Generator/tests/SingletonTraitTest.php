<?php
/**
 * @author hidehalo <tianchen_cc@yeah.net>
 * @copyright 2018 hidehlao
 * @license gpl-3.0
 */
namespace Hidehalo\Util\Generator\Test;

use RuntimeException;
use PHPUnit\Framework\TestCase;
use Hidehalo\Util\Generator\SingletonTrait;

class SingletonStub
{
    use SingletonTrait;
    // trait final keyword is not working like class, do not overwrite those methods plz.
    // final public function __wakeup(){}
    // final public function __clone(){}
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

    public function testClone()
    {
        $this->expectException(RuntimeException::class);
        $singleton = SingletonStub::singleton();
        $cloneInstance = clone $singleton;
        $this->assertSame($singleton, $cloneInstance);
    }

    public function testSerlization()
    {
        $this->expectException(RuntimeException::class);
        $singleton = SingletonStub::singleton();
        $serlized = serialize($singleton);
        $unserlized = unserialize($serlized);
        $this->assertSame($singleton, $unserlized);
    }
}
