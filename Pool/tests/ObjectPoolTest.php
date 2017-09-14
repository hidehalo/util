<?php
namespace Hidehalo\Util\Pool\Test;

use Exception;
use Hidehalo\Util\Pool\ObjectPool;
use Hidehalo\Util\Pool\ObjectPoolInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

class ObjectPoolTest extends TestCase
{
    /**
     * @dataProvider objectPoolProvider
     *
     * @param ObjectPoolInterface $pool
     * @param int                 $size
     * @param stdClass            $obj
     */
    public function testSetSizeAndGetSize(ObjectPoolInterface $pool, $size, $obj)
    {
        $pool->setSize($size);

        $this->assertEquals($size, $pool->getSize());
    }

    /**
     * @dataProvider objectPoolProvider
     *
     * @param ObjectPoolInterface $pool
     * @param int                 $size
     * @param stdClass            $obj
     */
    public function testContain(ObjectPoolInterface $pool, $size, $obj)
    {
        $this->assertFalse($pool->contain($obj));

        $pool->dispose($obj);
        $this->assertTrue($pool->contain($obj));
    }

    /**
     * @dataProvider objectPoolProvider
     *
     * @param ObjectPoolInterface $pool
     * @param int                 $size
     * @param stdClass            $obj
     */
    public function testDispose(ObjectPoolInterface $pool, $size, $obj)
    {
        $pool->dispose($obj);
        $this->assertTrue($pool->contain($obj));
    }

    /**
     * @dataProvider objectPoolProvider
     *
     * @param ObjectPoolInterface $pool
     * @param int                 $size
     * @param stdClass            $obj
     */
    public function testRemove(ObjectPoolInterface $pool, $size, $obj)
    {
        $pool->dispose($obj);
        $this->assertTrue($pool->contain($obj));

        $pool->remove($obj);
        $this->assertFalse($pool->contain($obj));
    }

    /**
     * @dataProvider objectPoolProvider
     *
     * @param ObjectPoolInterface $pool
     * @param int                 $size
     * @param stdClass            $obj
     */
    public function testDrain(ObjectPoolInterface $pool, $size, $obj)
    {
        $objects = $pool->drain();
        $this->assertEmpty($objects);

        $pool->dispose(new stdClass);
        $objects = $pool->drain();
        $this->assertEquals(1, count($objects));
    }

    /**
     * @dataProvider objectPoolProvider
     * @expectedException Exception
     *
     * @param ObjectPoolInterface $pool
     * @param int                 $size
     * @param stdClass            $obj
     */
    public function testGet(ObjectPoolInterface $pool, $size, $obj)
    {
        $pool->get();
        $pool->dispose($obj);
        $objSto = $pool->get();
        $this->assertEquals($objSto, $obj);
    }

    /**
     * @dataProvider objectPoolProvider
     *
     * @param ObjectPoolInterface $pool
     * @param int                 $size
     * @param stdClass            $obj
     */
    public function testIsOverflow(ObjectPoolInterface $pool, $size, $obj)
    {
        $isNotOverflow = !$pool->isOverflow();
        $this->assertTrue($isNotOverflow);
    }

    
    /**
     * @dataProvider objectPoolProvider
     *
     * @param ObjectPoolInterface $pool
     * @param int                 $size
     * @param stdClass            $obj
     */
    public function testEmpty(ObjectPoolInterface $pool, $size, $obj)
    {
        $empty = $pool->isEmpty();
        $this->assertTrue($empty);
    }

    /**
     * @return array
     */
    public function objectPoolProvider()
    {
        $size = mt_rand(1, 10);
        $obj = new stdClass();

        return [
            [new ObjectPool($size), $size, $obj],
        ];
    }
}
