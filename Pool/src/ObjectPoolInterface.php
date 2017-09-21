<?php
namespace Hidehalo\Util\Pool;

use Countable;
use Iterator;

interface ObjectPoolInterface extends Countable, Iterator
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
     * @return void
     */
    public function setSize($size);

    /**
     * @return integer
     */
     public function getSize();

    /**
     * @return bool
     */
    public function isFull();

    /**
     * @return bool
     */
    public function isEmpty();

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
