<?php
namespace Hidehalo\Util\Pool\Test;

use Hidehalo\Util\Pool\HashPool;
use Hidehalo\Util\Pool\ObjectPoolInterface;
use Hidehalo\Util\Pool\PoolResolverInterface;
use PHPUnit\Framework\TestCase;

class HashPoolTest extends TestCase
{
    /**
     * @param PoolResolverInterface $resolver
     * @param string                $name
     * @dataProvider connPoolProvider
     */
    public function testGetPool(PoolResolverInterface $resolver, $name)
    {
        $pool = $resolver->getPool($name);

        $this->assertInstanceOf(ObjectPoolInterface::class, $pool);
    }

    /**
     * @param PoolResolverInterface $resolver
     * @param string                $name
     * @dataProvider connPoolProvider
     */
    public function testHasPool(PoolResolverInterface $resolver, $name)
    {
        $hasPool = $resolver->hasPool($name);

        $this->assertFalse($hasPool);
    }

    /**
     * @param PoolResolverInterface $resolver
     * @param string                $_
     * @dataProvider connPoolProvider
     */
    public function testIsEmpty(PoolResolverInterface $resolver, $_)
    {
        $isEmpty = $resolver->isEmpty();

        $this->assertTrue($isEmpty);
    }

    /**
     * @param PoolResolverInterface $resolver
     * @param string                $name
     * @dataProvider connPoolProvider
     */
    public function testDestroyPools(PoolResolverInterface $resolver, $name)
    {
        $pool = $resolver->getPool($name);
        $this->assertInstanceOf(ObjectPoolInterface::class, $pool);

        $isNotEmpty = !$resolver->isEmpty();
        $this->assertTrue($isNotEmpty);

        $resolver->destroyPools();
        $isEmpty = $resolver->isEmpty();
        $this->assertTrue($isEmpty);
    }

    /**
     * @param PoolResolverInterface $resolver
     * @param string                $name
     * @dataProvider connPoolProvider
     */
    public function testTraversable(PoolResolverInterface $resolver, $name)
    {
        $size = 5;
        for ($i = 0; $i < $size; $i++) {
            $names[] = $name.$i;
            $resolver->getPool($name.$i);
        }
        $counter = 0;
        foreach ($resolver as $id => $pool) {
            $counter++;
            $this->assertInstanceOf(ObjectPoolInterface::class, $pool);
        }
        $this->assertEquals($size, $counter);
    }

    /**
     * @return array
     */
    public function connPoolProvider()
    {
        $name = 'TEST_POOL_NAME';
        $connPool = new HashPool();

        return [
            [$connPool, $name],
        ];
    }
}
