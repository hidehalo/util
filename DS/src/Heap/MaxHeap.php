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
     * @codeCoverageIgnore
     * @inheritDoc
     */
    protected function compare($a, $b)
    {
        if ($a > $b) {
            return self::PRI_HIGHER;
        }

        return self::PRI_LOWER;
    }

    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function getMax()
    {
        return $this->root();
    }

    /**
     * Undocumented function
     *
     * @return mixed
     */
    public function extractMax()
    {
        return $this->extractRoot();
    }

    /**
     * @todo impl
     */
    public function insertKey($value)
    {
        $this->insert($value);
    }

    public function increaseKey($i, $value)
    {
        $this->rearrange($i, $value);
    }

    /**
     * @todo impl
     */
    public function deleteKey($i)
    {
        $this->increaseKey($i, PHP_INT_MAX);
        $this->extractMax();
    }
}
