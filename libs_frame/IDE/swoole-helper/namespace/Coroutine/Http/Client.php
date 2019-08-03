<?php
namespace Swoole\Coroutine\Http;

/**
 * @since 4.4.3
 */
class Client
{


    /**
     * @param $host[required]
     * @param $port[optional]
     * @param $ssl[optional]
     * @return mixed
     */
    public function __construct($host, $port=null, $ssl=null){}

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
     * @return mixed
     */
    public function getDefer(){}

    /**
     * @param $defer[optional]
     * @return mixed
     */
    public function setDefer($defer=null){}

    /**
     * @param $method[required]
     * @return mixed
     */
    public function setMethod($method){}

    /**
     * @param $headers[required]
     * @return mixed
     */
    public function setHeaders($headers){}

    /**
     * @param $username[required]
     * @param $password[required]
     * @return mixed
     */
    public function setBasicAuth($username, $password){}

    /**
     * @param $cookies[required]
     * @return mixed
     */
    public function setCookies($cookies){}

    /**
     * @param $data[required]
     * @return mixed
     */
    public function setData($data){}

    /**
     * @param $path[required]
     * @param $name[required]
     * @param $type[optional]
     * @param $filename[optional]
     * @param $offset[optional]
     * @param $length[optional]
     * @return mixed
     */
    public function addFile($path, $name, $type=null, $filename=null, $offset=null, $length=null){}

    /**
     * @param $path[required]
     * @param $name[required]
     * @param $type[optional]
     * @param $filename[optional]
     * @return mixed
     */
    public function addData($path, $name, $type=null, $filename=null){}

    /**
     * @param $path[required]
     * @return mixed
     */
    public function execute($path){}

    /**
     * @param $path[required]
     * @return mixed
     */
    public function get($path){}

    /**
     * @param $path[required]
     * @param $data[required]
     * @return mixed
     */
    public function post($path, $data){}

    /**
     * @param $path[required]
     * @param $file[required]
     * @param $offset[optional]
     * @return mixed
     */
    public function download($path, $file, $offset=null){}

    /**
     * @return mixed
     */
    public function getBody(){}

    /**
     * @return mixed
     */
    public function getHeaders(){}

    /**
     * @return mixed
     */
    public function getCookies(){}

    /**
     * @return mixed
     */
    public function getStatusCode(){}

    /**
     * @param $path[required]
     * @return mixed
     */
    public function upgrade($path){}

    /**
     * @param $data[required]
     * @param $opcode[optional]
     * @param $finish[optional]
     * @return mixed
     */
    public function push($data, $opcode=null, $finish=null){}

    /**
     * @param $timeout[optional]
     * @return mixed
     */
    public function recv($timeout=null){}

    /**
     * @return mixed
     */
    public function close(){}


}
