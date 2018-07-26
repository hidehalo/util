<?php
/**
 * @author hidehalo <tianchen_cc@yeah.net>
 * @copyright 2018 hidehlao
 * @license gpl-3.0
 */
namespace Hidehalo\Util\Ds\Heap;

abstract class Heap
{
    /**
     * Variables
     * 
     * @final PRI_HIGHER 1 <constant of higher priority>
     * @final PRI_EQUAL 0 <constant of same priority>
     * @final PRI_LOWER -1 <constant of lower priority>
     * @property array $arr <storage of binary heap>
     * @property integer $size <size of storage>
     */
    const PRI_HIGHER = 1;
    const PRI_EQUAL = 0;
    const PRI_LOWER = -1;

    protected $arr;
    protected $size;

    /**
     * @codeCoverageIgnore
     *
     * @param integer $i
     * @return integer
     */
    protected function parent($i)
    {
        return ($i-1)>>1;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param integer $i
     * @return integer
     */
    protected function left($i)
    {
        return ($i<<1) + 1;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param integer $i
     * @return integer
     */
    protected function right($i)
    {
        return $this->left($i) + 1;
    }

    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    protected function root()
    {
        return isset($this->arr[0])? $this->arr[0] :false;
    }

    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    protected function extractRoot()
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
     * @codeCoverageIgnore
     * @param mixed $value
     * @return void
     */
    protected function insert($value)
    {
        $this->size++;
        $i = $this->size - 1;
        $this->arr[$i] = $value;
        while ($i!=0 && $this->compare($this->arr[$this->parent($i)], $this->arr[$i]) == self::PRI_LOWER) {
            $parent = $this->parent($i);
            $this->swap($i, $parent);
            $i = $parent;
        } 
    }

    /**
     * @codeCoverageIgnore
     * @param integer $i
     * @param mixed $value
     * @return void
     */
    protected function rearrange($i, $value)
    {
        $this->arr[$i] = $value;
        while ($i!=0 && $this->compare($this->arr[$this->parent($i)], $this->arr[$i]) != self::PRI_HIGHER) {
            $parent = $this->parent($i);
            $this->swap($i, $parent);
            $i = $parent;
        }
    }

    /**
     * Contructor
     * @codeCoverageIgnore
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
     * Compare priority of two elements 
     *
     * @param mixed $a
     * @param mixed $b
     * @return integer PRI_HIGHER|PRI_LOWER|PRI_EQUAL
     */
    abstract protected function compare($a, $b);

    /**
     * Swap two elements via indecies
     *
     * @param integer $i
     * @param integer $j
     * @return void
     */
    public function swap($i, $j)
    {
        $tmp = $this->arr[$i];
        $this->arr[$i] = $this->arr[$j];
        $this->arr[$j] = $tmp;
    }

    /**
     * Get size of elements
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Heapify
     *
     * @param integer $size
     * @param integer $i
     * @return void
     */
    public function heapify($size, $i)
    {
        $arr = &$this->arr;
        $higher = $i;
        $l = $this->left($i);
        $r = $l + 1;
        if ($l<$size && $this->compare($arr[$higher], $arr[$l]) != self::PRI_HIGHER) {
            $higher = $l;
        }
        if ($r<$size && $this->compare($arr[$higher], $arr[$r]) != self::PRI_HIGHER) {
            $higher = $r;
        }
        if ($higher != $i) {
            $this->swap($i, $higher);
            $this->heapify($size, $higher);
        }
    }
}
