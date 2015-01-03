<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bridge\Monolog;

use Monolog\Logger as BaseLogger;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

/**
 * Logger.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Logger extends BaseLogger implements LoggerInterface, DebugLoggerInterface
{
    /**
     * @deprecated since 2.2, to be removed in 3.0. Use emergency() which is PSR-3 compatible.
     */
    public function emerg($message, array $context = array())
    {
        trigger_error('The emerg() method of the Monolog Logger was removed. You should use the new method emergency() instead, which is PSR-3 compatible.', E_USER_DEPRECATED);

        return parent::addRecord(BaseLogger::EMERGENCY, $message, $context);
    }

    /**
     * @deprecated since 2.2, to be removed in 3.0. Use critical() which is PSR-3 compatible.
     */
    public function crit($message, array $context = array())
    {
        trigger_error('The crit() method of the Monolog Logger was removed. You should use the new method critical() instead, which is PSR-3 compatible.', E_USER_DEPRECATED);

        return parent::addRecord(BaseLogger::CRITICAL, $message, $context);
    }

    /**
     * @deprecated since 2.2, to be removed in 3.0. Use error() which is PSR-3 compatible.
     */
    public function err($message, array $context = array())
    {
        trigger_error('The err() method of the Monolog Logger was removed. You should use the new method error() instead, which is PSR-3 compatible.', E_USER_DEPRECATED);

        return parent::addRecord(BaseLogger::ERROR, $message, $context);
    }

    /**
     * @deprecated since 2.2, to be removed in 3.0. Use warning() which is PSR-3 compatible.
     */
    public function warn($message, array $context = array())
    {
        trigger_error('The warn() method of the Monolog Logger was removed. You should use the new method warning() instead, which is PSR-3 compatible.', E_USER_DEPRECATED);

        return parent::addRecord(BaseLogger::WARNING, $message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function getLogs()
    {
        if ($logger = $this->getDebugLogger()) {
            return $logger->getLogs();
        }

        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function countErrors()
    {
        if ($logger = $this->getDebugLogger()) {
            return $logger->countErrors();
        }

        return 0;
    }

    /**
     * Returns a DebugLoggerInterface instance if one is registered with this logger.
     *
     * @return DebugLoggerInterface|null A DebugLoggerInterface instance or null if none is registered
     */
    private function getDebugLogger()
    {
        foreach ($this->handlers as $handler) {
            if ($handler instanceof DebugLoggerInterface) {
                return $handler;
            }
        }
    }
}
