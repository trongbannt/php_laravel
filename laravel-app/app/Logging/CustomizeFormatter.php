<?php
namespace App\Logging;
use Monolog\Formatter\LineFormatter;

class CustomizeFormatter
{
    public const SIMPLE_FORMAT = "%channel%.%level_name%|[%datetime%]| %message% %context% %extra%\n";
    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger  $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
               $this->SIMPLE_FORMAT
            ));
        }
    }
}
?>