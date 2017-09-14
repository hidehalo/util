<?php

namespace Hidehalo\Db\Util;

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
