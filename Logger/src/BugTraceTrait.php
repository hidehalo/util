<?php
namespace Hidehalo\Util\Logger;

use Exception;
use Psr\Log\LoggerInterface;

trait BugTraceTrait
{
    /**
     * @var bool
     */
    private $debugTrigger;

    /**
     * @codeCoverageIgnore
     *
     * @param Exception            $e
     * @param LoggerInterface|null $logger
     * @throw Exception
     *
     * @return void
     */
    abstract public function trace(Exception $e, LoggerInterface &$logger = null);

    /**
     * @codeCoverageIgnore
     *
     * @param $flag
     *
     * @return $this
     */
    protected function setDebug($flag)
    {
        $this->debugTrigger = $flag === true ? true : false;

        return $this;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return bool
     */
    protected function isTraceBug()
    {
        return $this->debugTrigger;
    }
}
