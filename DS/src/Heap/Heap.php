<?php
/**
 * @author hidehalo <tianchen_cc@yeah.net>
 * @copyright 2018 hidehlao
 * @license gpl-3.0
 */
namespace Hidehalo\Util\Ds\Heap;

abstract class Heap
{
    protected $arr;
    protected $size;

    /**
     * Contructor
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
     *
     *
     * @param integer $a
     * @param integer $b
     * @return integer
     */
    abstract public function compare($a, $b);

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
