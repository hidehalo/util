<?php
/**
 * @author hidehalo <tianchen_cc@yeah.net>
 * @copyright 2018 hidehlao
 * @license gpl-3.0
 */
namespace Hidehalo\Util\Generator;

use RuntimeException;

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
    final public function __wakeup()
    {
        throw new RuntimeException("Singleton could not be unserialized");
    }

    /**
     * @inheritDoc
     */
    final public function __clone()
    {
        throw new RuntimeException("Singleton could not be cloned");
    }
}
