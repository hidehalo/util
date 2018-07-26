<?php
/**
 * @author hidehalo <tianchen_cc@yeah.net>
 * @copyright 2018 hidehlao
 * @license gpl-3.0
 */
namespace Hidehalo\Util\Ds\Test\Heap;

use PHPUnit\Framework\TestCase;
use Hidehalo\Util\Ds\Heap\MaxHeap;

class MaxHeapTest extends TestCase
{
    /**
     * @dataProvider maxheapProvider
     * @param MaxHeap $heap
     * @return void
     */
    public function testExtractMax(MaxHeap $heap)
    {
        $max = $heap->extractMax();
        $this->assertSame(6, $max);
        $this->assertSame(5, $heap->getSize());
    }

    /**
     * @dataProvider maxheapProvider
     * @param MaxHeap $heap
     * @return void
     */
    public function testGetMax(MaxHeap $heap)
    {
        $max = $heap->getMax();
        $this->assertSame(6, $max);
        $this->assertSame(6, $heap->getSize());
    }

    /**
     * @dataProvider maxheapProvider
     * @param MaxHeap $heap
     * @return void
     */
    public function testIncreaseKey(MaxHeap $heap)
    {
        $heap->increaseKey(3, PHP_INT_MAX);
        $max = $heap->getMax();
        $this->assertSame(PHP_INT_MAX, $max);
        $this->assertSame(6, $heap->getSize());
    }

    /**
     * @dataProvider maxheapProvider
     * @param MaxHeap $heap
     * @return void
     */
    public function testInsertKey(MaxHeap $heap)
    {
        $heap->insertKey(7);
        $max = $heap->getMax();
        $this->assertSame(7, $max);
        $this->assertSame(7, $heap->getSize());
    }

    /**
     * @dataProvider maxheapProvider
     * @param MaxHeap $heap
     * @return void
     */
    public function testDeleteKey(MaxHeap $heap)
    {
        $heap->deleteKey(0);
        $max = $heap->getMax();
        $this->assertSame(5, $max);
        $this->assertSame(5, $heap->getSize());
    }

    /**
     * @return MaxHeap $heap
     */
    public function maxheapProvider()
    {
        $heap = new MaxHeap([1, 3, 5, 2, 4, 6]);

        return [
            [ $heap ],
        ];
    }
}
