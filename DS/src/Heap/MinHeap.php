<?php
/**
 * @author hidehalo <tianchen_cc@yeah.net>
 * @copyright 2018 hidehlao
 * @license gpl-3.0
 */
namespace Hidehalo\Util\Ds\Heap;

class MinHeap extends Heap
{
    /**
     * @codeCoverageIgnore
     * @inheritDoc
     */
    protected function compare($a, $b)
    {
        if ($a < $b) {
            return self::PRI_HIGHER;
        }

        return self::PRI_LOWER;
    }

    public function getMin()
    {
        return $this->root();
    }

    public function extractMin()
    {
        return $this->extractRoot();
    }

    public function insertKey($value)
    {
        $this->insert($value);
    }

    public function decreaseKey($i, $value)
    {
        $this->rearrange($i, $value);
    }

    public function deleteKey($i)
    {
        $this->decreaseKey($i, PHP_INT_MIN);
        $this->extractMin();
    }
}
