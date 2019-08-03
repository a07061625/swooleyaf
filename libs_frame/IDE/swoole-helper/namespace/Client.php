<?php
namespace Swoole;

/**
 * @since 4.4.3
 */
class Client
{
    const MSG_OOB = 1;
    const MSG_PEEK = 2;
    const MSG_DONTWAIT = 64;
    const MSG_WAITALL = 256;
    const SHUT_RDWR = 2;
    const SHUT_RD = 0;
    const SHUT_WR = 1;


    /**
     * @param $type[required]
     * @param $async[optional]
     * @return mixed
     */
    public function __construct($type, $async=null){}

    /**
     * @return mixed
     */
    public function __destruct(){}

    /**
     * @param $settings[required]
     * @return mixed
     */
    public function set($settings){}

    /**
     * @param $host[required]
     * @param $port[optional]
     * @param $timeout[optional]
     * @param $sock_flag[optional]
     * @return mixed
     */
    public function connect($host, $port=null, $timeout=null, $sock_flag=null){}

    /**
     * @param $size[optional]
     * @param $flag[optional]
     * @return mixed
     */
    public function recv($size=null, $flag=null){}

    /**
     * @param $data[required]
     * @param $flag[optional]
     * @return mixed
     */
    public function send($data, $flag=null){}

    /**
     * @param $dst_socket[required]
     * @return mixed
     */
    public function pipe($dst_socket){}

    /**
     * @param $filename[required]
     * @param $offset[optional]
     * @param $length[optional]
     * @return mixed
     */
    public function sendfile($filename, $offset=null, $length=null){}

    /**
     * @param $ip[required]
     * @param $port[required]
     * @param $data[required]
     * @return mixed
     */
    public function sendto($ip, $port, $data){}

    /**
     * @return mixed
     */
    public function sleep(){}

    /**
     * @return mixed
     */
    public function wakeup(){}

    /**
     * @return mixed
     */
    public function pause(){}

    /**
     * @return mixed
     */
    public function resume(){}

    /**
     * @param $how[required]
     * @return mixed
     */
    public function shutdown($how){}

    /**
     * @param $callback[optional]
     * @return mixed
     */
    public function enableSSL($callback=null){}

    /**
     * @return mixed
     */
    public function getPeerCert(){}

    /**
     * @return mixed
     */
    public function verifyPeerCert(){}

    /**
     * @return mixed
     */
    public function isConnected(){}

    /**
     * @return mixed
     */
    public function getsockname(){}

    /**
     * @return mixed
     */
    public function getpeername(){}

    /**
     * @param $force[optional]
     * @return mixed
     */
    public function close($force=null){}

    /**
     * @param $event_name[required]
     * @param $callback[required]
     * @return mixed
     */
    public function on($event_name, $callback){}

    /**
     * @return mixed
     */
    public function getSocket(){}


}
