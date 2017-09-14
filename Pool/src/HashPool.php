<?php
namespace Hidehalo\Util\Pool;

class HashPool implements PoolResolverInterface
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
     * @param $name
     *
     * @return ObjectPoolInterface
     */
    public function getPool($name)
    {
        if (!$this->hasPool($name)) {
            $this->pools[$name] = new ObjectPool($this->size ?: self::DEFAULT_SIZE);
        }

        return $this->pools[$name];
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasPool($name)
    {
        return isset($this->pools[$name]);
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
     * @codeCoverageIgnore
     */
    public function __destruct()
    {
        $this->destroyPools();
    }
}