<?php
namespace Hidehalo\Util\Generator;

trait SingletonTrait
{
    /**
     * @param ...$params
     *
     * @return static
     */
    final public static function singleton(...$params)
    {
        static $singleton;
        if (!$singleton) {
            $singleton = new static(...$params);
        }

        return $singleton;
    }

    /**
     * @inheritDoc
     */
    final function __wakeup()
    {
    }

    /**
     * @inheritDoc
     */
    final function __clone()
    {
    }
}
