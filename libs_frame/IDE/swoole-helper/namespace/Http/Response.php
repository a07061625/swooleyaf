<?php

namespace Swoole\Http;

/**
 * @since 4.6.2
 */
class Response
{
    /**
     * @return mixed
     */
    public function __destruct()
    {
    }

    /**
     * @return mixed
     */
    public function initHeader()
    {
    }

    /**
     * @return mixed
     */
    public function isWritable()
    {
    }

    /**
     * @param $name[required]
     * @param $value[optional]
     * @param $expires[optional]
     * @param $path[optional]
     * @param $domain[optional]
     * @param $secure[optional]
     * @param $httponly[optional]
     * @param $samesite[optional]
     * @param $priority[optional]
     *
     * @return mixed
     */
    public function cookie($name, $value = null, $expires = null, $path = null, $domain = null, $secure = null, $httponly = null, $samesite = null, $priority = null)
    {
    }

    /**
     * @param $name[required]
     * @param $value[optional]
     * @param $expires[optional]
     * @param $path[optional]
     * @param $domain[optional]
     * @param $secure[optional]
     * @param $httponly[optional]
     * @param $samesite[optional]
     * @param $priority[optional]
     *
     * @return mixed
     */
    public function setCookie($name, $value = null, $expires = null, $path = null, $domain = null, $secure = null, $httponly = null, $samesite = null, $priority = null)
    {
    }

    /**
     * @param $name[required]
     * @param $value[optional]
     * @param $expires[optional]
     * @param $path[optional]
     * @param $domain[optional]
     * @param $secure[optional]
     * @param $httponly[optional]
     * @param $samesite[optional]
     * @param $priority[optional]
     *
     * @return mixed
     */
    public function rawcookie($name, $value = null, $expires = null, $path = null, $domain = null, $secure = null, $httponly = null, $samesite = null, $priority = null)
    {
    }

    /**
     * @param $http_code[required]
     * @param $reason[optional]
     *
     * @return mixed
     */
    public function status($http_code, $reason = null)
    {
    }

    /**
     * @param $http_code[required]
     * @param $reason[optional]
     *
     * @return mixed
     */
    public function setStatusCode($http_code, $reason = null)
    {
    }

    /**
     * @param $key[required]
     * @param $value[required]
     * @param $format[optional]
     *
     * @return mixed
     */
    public function header($key, $value, $format = null)
    {
    }

    /**
     * @param $key[required]
     * @param $value[required]
     * @param $format[optional]
     *
     * @return mixed
     */
    public function setHeader($key, $value, $format = null)
    {
    }

    /**
     * @param $key[required]
     * @param $value[required]
     *
     * @return mixed
     */
    public function trailer($key, $value)
    {
    }

    /**
     * @return mixed
     */
    public function ping()
    {
    }

    /**
     * @return mixed
     */
    public function goaway()
    {
    }

    /**
     * @param $content[required]
     *
     * @return mixed
     */
    public function write($content)
    {
    }

    /**
     * @param $content[optional]
     *
     * @return mixed
     */
    public function end($content = null)
    {
    }

    /**
     * @param $filename[required]
     * @param $offset[optional]
     * @param $length[optional]
     *
     * @return mixed
     */
    public function sendfile($filename, $offset = null, $length = null)
    {
    }

    /**
     * @param $location[required]
     * @param $http_code[optional]
     *
     * @return mixed
     */
    public function redirect($location, $http_code = null)
    {
    }

    /**
     * @return mixed
     */
    public function detach()
    {
    }

    /**
     * @param $server[required]
     * @param $fd[optional]
     *
     * @return mixed
     */
    public static function create($server, $fd = null)
    {
    }

    /**
     * @return mixed
     */
    public function upgrade()
    {
    }

    /**
     * @param $data[required]
     * @param $opcode[optional]
     * @param $flags[optional]
     *
     * @return mixed
     */
    public function push($data, $opcode = null, $flags = null)
    {
    }

    /**
     * @return mixed
     */
    public function recv()
    {
    }

    /**
     * @return mixed
     */
    public function close()
    {
    }
}
