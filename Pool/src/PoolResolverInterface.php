<?php
namespace Hidehalo\Util\Pool;

interface PoolResolverInterface
{
    /**
     * @param $name
     *
     * @return ObjectPoolInterface
     */
    public function getPool($name);

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasPool($name);

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @return void
     */
    public function destroyPools();
}
