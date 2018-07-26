<?php
/**
 * @author hidehalo <tianchen_cc@yeah.net>
 * @copyright 2018 hidehlao
 * @license gpl-3.0
 */

/**
 * Heap sort
 *
 * @param \Hidehalo\Util\Ds\Heap\Heap $heap
 * @return void
 */
function heap_sort(\Hidehalo\Util\Ds\Heap\Heap $heap)
{
    for ($i=$heap->getSize()-1; $i>=0; $i--) {
        $heap->swap(0, $i);
        $heap->heapify($i, 0);
    }
}
