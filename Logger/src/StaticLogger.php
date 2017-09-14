<?php
namespace Hidehalo\Util\Logger;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class StaticLogger extends Logger implements LoggerInterface
{
    use SingletonTrait;

    /**
     * @var
     */
    private $defaultHandler;
    /**
     * @var string
     */
    private $logPath;

    /**
     * @param string $logPath
     */
    public function __construct($logPath)
    {
        $this->logPath = $logPath;
        $this->defaultHandler = new RotatingFileHandler($logPath.'/crash.log', 30);
        parent::__construct('bug-trace', [$this->defaultHandler]);
    }
}
