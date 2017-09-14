<?php
namespace Hidehalo\Util\Logger;

use Psr\Log\LoggerInterface;

interface LoggerManagerInterface
{
    public function setLogger(LoggerInterface $logger);

    public function getLogger();
}
