<?php
namespace Swoole\Http;

/**
 * @since 4.4.3
 */
class Response
{


    /**
     * @return mixed
     */
    public function initHeader(){}

    /**
     * @param $name[required]
     * @param $value[optional]
     * @param $expires[optional]
     * @param $path[optional]
     * @param $domain[optional]
     * @param $secure[optional]
     * @param $httponly[optional]
     * @return mixed
     */
    public function cookie($name, $value=null, $expires=null, $path=null, $domain=null, $secure=null, $httponly=null){}

    /**
     * @param $name[required]
     * @param $value[optional]
     * @param $expires[optional]
     * @param $path[optional]
     * @param $domain[optional]
     * @param $secure[optional]
     * @param $httponly[optional]
     * @return mixed
     */
    public function setCookie($name, $value=null, $expires=null, $path=null, $domain=null, $secure=null, $httponly=null){}

    /**
     * @param $name[required]
     * @param $value[optional]
     * @param $expires[optional]
     * @param $path[optional]
     * @param $domain[optional]
     * @param $secure[optional]
     * @param $httponly[optional]
     * @return mixed
     */
    public function rawcookie($name, $value=null, $expires=null, $path=null, $domain=null, $secure=null, $httponly=null){}

    /**
     * @param $http_code[required]
     * @param $reason[optional]
     * @return mixed
     */
    public function status($http_code, $reason=null){}

    /**
     * @param $http_code[required]
     * @param $reason[optional]
     * @return mixed
     */
    public function setStatusCode($http_code, $reason=null){}

    /**
     * @param $key[required]
     * @param $value[required]
     * @param $ucwords[optional]
     * @return mixed
     */
    public function header($key, $value, $ucwords=null){}

    /**
     * @param $key[required]
     * @param $value[required]
     * @param $ucwords[optional]
     * @return mixed
     */
    public function setHeader($key, $value, $ucwords=null){}

    /**
     * @param $key[required]
     * @param $value[required]
     * @return mixed
     */
    public function trailer($key, $value){}

    /**
     * @return mixed
     */
    public function ping(){}

    /**
     * @param $content[required]
     * @return mixed
     */
    public function write($content){}

    /**
     * @param $content[optional]
     * @return mixed
     */
    public function end($content=null){}

    /**
     * @param $filename[required]
     * @param $offset[optional]
     * @param $length[optional]
     * @return mixed
     */
    public function sendfile($filename, $offset=null, $length=null){}

    /**
     * @param $location[required]
     * @param $http_code[optional]
     * @return mixed
     */
    public function redirect($location, $http_code=null){}

    /**
     * @return mixed
     */
    public function detach(){}

    /**
     * @param $fd[required]
     * @return mixed
     */
    public static function create($fd){}

    /**
     * @return mixed
     */
    public function upgrade(){}

    /**
     * @return mixed
     */
    public function push(){}

    /**
     * @return mixed
     */
    public function recv(){}

    /**
     * @return mixed
     */
    public function __destruct(){}


}
