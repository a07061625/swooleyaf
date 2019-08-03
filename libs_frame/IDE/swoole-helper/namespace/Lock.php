<?php
namespace Swoole;

/**
 * @since 4.4.3
 */
class Lock
{
    const FILELOCK = 2;
    const MUTEX = 3;
    const SEM = 4;
    const RWLOCK = 1;
    const SPINLOCK = 5;


    /**
     * @param $type[optional]
     * @param $filename[optional]
     * @return mixed
     */
    public function __construct($type=null, $filename=null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @return mixed
     */
    public function lock(){}

    /**
     * @param $timeout[optional]
     * @return mixed
     */
    public function lockwait($timeout=null){}

    /**
     * @return mixed
     */
    public function trylock(){}

    /**
     * @return mixed
     */
    public function lock_read(){}

    /**
     * @return mixed
     */
    public function trylock_read(){}

    /**
     * @return mixed
     */
    public function unlock(){}

    /**
     * @return mixed
     */
    public function destroy(){}


}
