<?php
/**
 * @author hidehalo <tianchen_cc@yeah.net>
 * @copyright 2018 hidehlao
 * @license gpl-3.0
 */
namespace Hidehalo\Util\Ds\Heap;

class MaxHeap extends Heap
{
    /**
     * @inheritDoc
     */
    public function compare($a, $b)
    {
        if ($a < $b) {
            return 1;
        }

        return 0;
    }

    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function extractMax()
    {
        if ($this->size <= 0) {
            return false;
        }
        if ($this->size == 1) {
            $this->size--;

            return $this->arr[0];
        }
    
        $root = $this->arr[0];
        $this->arr[0] = $this->arr[$this->size-1];
        $this->size--;
        $this->heapify($this->size, 0);
    
        return $root;
    }

    /**
     * @todo impl
     */
    public function insert()
    {
    }

    public function decreaseKey($i, $value)
    {
        $arr[$i] = $value;
        while ($i!=0 && $this->compare($arr[($i-1)/2], $arr[$i])) {
            $parent = ($i-1)/2;
            $this->swap($arr[$i], $arr[$parent]);
            $i = $parent;
        }
    }

    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function getMax()
    {
        return isset($this->heap->arr[0])? $this->heap->arr[0] :false;
    }

    /**
     * @todo impl
     */
    public function delete()
    {
    }
}
