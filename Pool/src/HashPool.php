<?php
namespace Hidehalo\Util\Pool;

use Hidehalo\Util\Generator\SingletonTrait;
use Iterator;

class HashPool implements PoolResolverInterface, Iterator
{
    use SingletonTrait;

    const DEFAULT_SIZE = 1;
    /**
     * @var array
     */
    private $pools;

    /**
     * @var
     */
    private $size;

    /**
     * @codeCoverageIgnore
     *
     * @param null $size
     */
    public function __construct($size = null)
    {
        $this->size = $size > 0 ? $size : self::DEFAULT_SIZE;
    }

    /**
     * @param $id
     *
     * @return ObjectPoolInterface
     */
    public function getPool($id)
    {
        if (!$this->hasPool($id)) {
            $this->pools[$id] = new ObjectPool($this->size ?: self::DEFAULT_SIZE);
        }

        return $this->pools[$id];
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function hasPool($id)
    {
        return isset($this->pools[$id]);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->pools);
    }

    public function destroyPools()
    {
        //@codeCoverageIgnoreStart
        if ($this->isEmpty()) {
            return;
        }
        //@codeCoverageIgnoreEnd
        foreach ($this->pools as &$pool) {
            /*
             * @var ObjectPoolInterface $pool
             */
            $pool->drain();
        }
        $this->pools = null;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return current($this->pools);
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        return next($this->pools);
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return key($this->pools);
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return key($this->pools) !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        return reset($this->pools);
    }


    /**
     * @codeCoverageIgnore
     */
    public function __destruct()
    {
        $this->destroyPools();
    }
}
