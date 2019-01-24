<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/23 0023
 * Time: 9:13
 */
namespace Response;

use Constant\Server;
use Traits\SimpleTrait;
use Yaf\Registry;

class SyResponseHttp extends SyResponse {
    use SimpleTrait;

    /**
     * 设置头部信息
     * @param $key
     * @param $value
     */
    public static function header($key,$value){
        self::headers([
            $key => $value,
        ]);
    }

    public static function headers(array $headers){
        $existHeaders = Registry::get(Server::REGISTRY_NAME_RESPONSE_HEADER);
        if($existHeaders !== false){
            foreach ($headers as $eKey => $eValue) {
                $headerName = ucwords(preg_replace('/\s+/', '', $eKey), " -\t\r\n\f\v");
                if(strlen($headerName) > 0){
                    $existHeaders[$headerName] = trim($eValue);
                }
            }

            Registry::set(Server::REGISTRY_NAME_RESPONSE_HEADER, $existHeaders);
        }
    }

    /**
     * 设置cookie
     * @param string $name 键名
     * @param mixed $value 键值
     * @param int $expires 超时时间戳
     * @param string $path 路径
     * @param string $domain 域名
     * @param bool $secure 是否通过https传输
     * @param bool $httponly 是否只允许http协议
     * @return void
     */
    public static function cookie(string $name, $value=null,int $expires=0,string $path='/',string $domain='',bool $secure=false,bool $httponly=false){
        self::cookies([
            0 => [
                'key' => $name,
                'value' => $value,
                'expires' => $expires,
                'path' => $path,
                'domain' => $domain,
                'secure' => $secure,
                'httponly' => $httponly,
            ],
        ]);
    }

    public static function cookies(array $cookies){
        $existCookies = Registry::get(Server::REGISTRY_NAME_RESPONSE_COOKIE);
        if($existCookies !== false){
            foreach ($cookies as $eCookie) {
                $existCookies[] = $eCookie;
            }

            Registry::set(Server::REGISTRY_NAME_RESPONSE_COOKIE, $existCookies);
        }
    }

    /**
     * 重定向
     * @param string $url 重定向链接地址
     */
    public static function redirect(string $url) {
        if(preg_match('/^(http|https)\:\/\/\S+$/', $url) > 0){
            self::headers([
                'Location' => $url,
            ]);
        }
    }
}