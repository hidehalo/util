<?php

namespace Hidehalo\Db\Util;

interface ObjectPoolInterface
{
    /**
     * @param $object
     *
     * @return void
     */
    public function dispose($object);

    /**
     * @return mixed
     */
    public function get();

    /**
     * @param $object
     *
     * @return bool
     */
    public function contain($object);

    /**
     * @param $size
     *
     * @return mixed
     */
    public function setSize($size);

    /**
     * @return int
     */
    public function count();

    /**
     * @return bool
     */
    public function isFull();

    /**
     * @return bool
     */
    public function isOverflow();

    /**
     * @param $object
     *
     * @return mixed
     */
    public function remove($object);

    /**
     * @return object[] array
     */
    public function drain();
}
