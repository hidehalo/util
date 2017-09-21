<?php
namespace Hidehalo\Util\Pool;

use Countable;
use Iterator;

class ObjectPool implements ObjectPoolInterface
{
    /**
     * @var int
     */
    private $size;
    /**
     * @var array
     */
    private $objects;

    /**
     * @codeCoverageIgnore
     * @param int $size
     */
    public function __construct($size = 1)
    {
        $this->size = $size;
        $this->objects = [];
    }

    /**
     * @param $object
     */
    public function dispose($object)
    {
        if (!$this->contain($object) && !$this->isFull() && !$this->isOverflow()) {
            $this->objects[spl_object_hash($object)] = $object;
        }
    }

    /**
     * @throws \Exception
     *
     * @return mixed
     */
    public function get()
    {
        if ($this->count() <= 0) {
            throw new \Exception('Object pool is empty');
        }
        $index = array_rand($this->objects);

        return $this->objects[$index];
    }

    /**
     * @param $object
     *
     * @return bool
     */
    public function contain($object)
    {
        return isset($this->objects[spl_object_hash($object)]);
    }

    /**
     * @param $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

     /**
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return bool
     */
    public function isOverflow()
    {
        return $this->size < $this->count();
    }

    /**
     * @return bool
     */
    public function isFull()
    {
        return $this->size == $this->count();
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->count() <=0;
    }

    /**
     * @param $object
     *
     * @return mixed
     */
    public function remove($object)
    {
        $tmp = $this->objects[spl_object_hash($object)];
        $this->objects[spl_object_hash($object)] = null;
        unset($this->objects[spl_object_hash($object)]);

        return $tmp;
    }

    /**
     * @return array
     */
    public function drain()
    {
        $tmp = $this->objects;
        foreach ($this->objects as $object) {
            // @codeCoverageIgnoreStart
            $this->remove($object);
            //@codeCoverageIgnoreEnd
        }

        return $tmp;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->objects);
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return current($this->objects);
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        return next($this->objects);
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return key($this->objects);
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return key($this->objects) !== null;
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        return reset($this->objects);
    }
}
