<?php

namespace Swoole;

/**
 * @since 4.6.2
 */
class ExitException extends \Swoole\Exception
{
    /**
     * @param $message[optional]
     * @param $code[optional]
     * @param $previous[optional]
     *
     * @return mixed
     */
    public function __construct($message = null, $code = null, $previous = null)
    {
    }

    /**
     * @return mixed
     */
    public function __wakeup()
    {
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
    }

    /**
     * @return mixed
     */
    public function getFlags()
    {
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
    }
}
