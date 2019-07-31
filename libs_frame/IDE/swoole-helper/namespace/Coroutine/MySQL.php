<?php
namespace Swoole\Coroutine;

/**
 * @since 4.3.6
 */
class MySQL
{


    /**
     * @return mixed
     */
    public function __construct(){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $server_config[required]
     * @return mixed
     */
    public function connect($server_config){}

    /**
     * @param $sql[required]
     * @param $timeout[optional]
     * @return mixed
     */
    public function query($sql, $timeout=null){}

    /**
     * @return mixed
     */
    public function recv(){}

    /**
     * @return mixed
     */
    public function nextResult(){}

    /**
     * @param $timeout[optional]
     * @return mixed
     */
    public function begin($timeout=null){}

    /**
     * @param $timeout[optional]
     * @return mixed
     */
    public function commit($timeout=null){}

    /**
     * @param $timeout[optional]
     * @return mixed
     */
    public function rollback($timeout=null){}

    /**
     * @param $statement[required]
     * @param $timeout[optional]
     * @return mixed
     */
    public function prepare($statement, $timeout=null){}

    /**
     * @param $defer[optional]
     * @return mixed
     */
    public function setDefer($defer=null){}

    /**
     * @return mixed
     */
    public function getDefer(){}

    /**
     * @return mixed
     */
    public function close(){}


}
