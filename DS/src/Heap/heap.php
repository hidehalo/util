<?php

abstract class Heap
{
    protected $arr;
    protected $size;

    /**
     * Undocumented function
     *
     * @param array $elments
     */
    public function __construct(array $elments)
    {
        $this->arr = $elments;
        $this->size = count($elments);
        for ($i=($this->size-1)/2; $i>=0; $i--) {
            $this->heapify($this->size, $i);
        }
    }

    /**
     * Undocumented function
     *
     * @param mixed $a
     * @param mixed $b
     * @return integer
     */
    public abstract function compare($a, $b);

    /**
     * Undocumented function
     *
     * @param mixed $i
     * @param mixed $j
     * @return void
     */
    public function swap($i, $j)
    {
        $tmp = $this->arr[$i];
        $this->arr[$i] = $this->arr[$j];
        $this->arr[$j] = $tmp;
    }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Undocumented function
     * 
     * @param integer $size
     * @param integer $i
     * @return void
     */
    public function heapify($size, $i)
    {
        $arr = &$this->arr;
        $max = $i;
        $l = ($i<<1) + 1;
        $r = $l + 1;
        if ($l<$size && $this->compare($arr[$max], $arr[$l])>0) {
            $max = $l;
        }
        if ($r<$size && $this->compare($arr[$max], $arr[$r])>0) {
            $max = $r;
        }
        if ($max != $i) {
            $this->swap($i, $max);
            $this->heapify($size, $max);
        }
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        $contents = '';
        foreach ($this->arr as $i => $elm) {
            $contents .= $i.':'.(string)$elm.PHP_EOL;
        }

        return $contents;
    }
}

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

$maxHeap = new MaxHeap([1,2,3,4,5,16,14,12,11,32,21,999,0,8,9,77]);

echo (string)$maxHeap.PHP_EOL;

function heap_sort(Heap $heap) {
    for ($i=$heap->getSize()-1; $i>=0; $i--) {
        $heap->swap(0, $i);
        $heap->heapify($i, 0);
    }
}

heap_sort($maxHeap);

echo (string)$maxHeap;