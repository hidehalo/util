<?php
namespace Hidehalo\Util\Logger;

use Psr\Log\LoggerInterface;

trait LoggerAwareTrait
{
    private $logger;

    /**
     * @codeCoverageIgnore
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
