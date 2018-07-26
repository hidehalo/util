<?php
/**
 * @author hidehalo <tianchen_cc@yeah.net>
 * @copyright 2018 hidehlao
 * @license gpl-3.0
 */
namespace Hidehalo\Util\Ds\Test\Heap;

use PHPUnit\Framework\TestCase;
use Hidehalo\Util\Ds\Heap\MinHeap;

class MinHeapTest extends TestCase
{
    /**
     * @dataProvider minheapProvider
     * @param MinHeap $heap
     * @return void
     */
    public function testExtractMin(MinHeap $heap)
    {
        $min = $heap->extractMin();
        $this->assertSame(1, $min);
        $this->assertSame(5, $heap->getSize());
    }

    /**
     * @dataProvider minheapProvider
     * @param MinHeap $heap
     * @return void
     */
    public function testGetMin(MinHeap $heap)
    {
        $min = $heap->getMin();
        $this->assertSame(1, $min);
        $this->assertSame(6, $heap->getSize());
    }

    /**
     * @dataProvider minheapProvider
     * @param MinHeap $heap
     * @return void
     */
    public function testDecreaseKey(MinHeap $heap)
    {
        $heap->decreaseKey(3, PHP_INT_MIN);
        $min = $heap->getMin();
        $this->assertSame(PHP_INT_MIN, $min);
        $this->assertSame(6, $heap->getSize());
    }

    /**
     * @dataProvider minheapProvider
     * @param MinHeap $heap
     * @return void
     */
    public function testInsertKey(MinHeap $heap)
    {
        $heap->insertKey(-1);
        $min = $heap->getMin();
        $this->assertSame(-1, $min);
        $this->assertSame(7, $heap->getSize());
    }

    /**
     * @dataProvider minheapProvider
     * @param MinHeap $heap
     * @return void
     */
    public function testDeleteKey(MinHeap $heap)
    {
        $heap->deleteKey(0);
        $min = $heap->getMin();
        $this->assertSame(2, $min);
        $this->assertSame(5, $heap->getSize());
    }

    /**
     * @return MinHeap $heap
     */
    public function minheapProvider()
    {
        $heap = new MinHeap([6, 2, 3, 4, 5, 1]);

        return [
            [ $heap ],
        ];
    }
}
