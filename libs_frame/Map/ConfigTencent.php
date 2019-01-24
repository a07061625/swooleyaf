<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:28
 */
namespace Map;

use Constant\ErrorCode;
use Exception\Map\TencentMapException;

class ConfigTencent {
    /**
     * 开发密钥
     * @var string
     */
    private $key = '';
    /**
     * 服务器IP
     * @var string
     */
    private $serverIp = '';

    public function __construct(){
    }

    private function __clone(){
    }

    /**
     * @return string
     */
    public function getKey() : string {
        return $this->key;
    }

    /**
     * @param string $key
     * @throws \Exception\Map\TencentMapException
     */
    public function setKey(string $key) {
        if(preg_match('/^(\-[0-9A-Z]{5}){6}$/', '-' . $key) > 0){
            $this->key = $key;
        } else {
            throw new TencentMapException('密钥不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getServerIp() : string {
        return $this->serverIp;
    }

    /**
     * @param string $serverIp
     * @throws \Exception\Map\TencentMapException
     */
    public function setServerIp(string $serverIp){
        if(preg_match('/^(\.(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])){4}$/', '.' . $serverIp) > 0){
            $this->serverIp = $serverIp;
        } else {
            throw new TencentMapException('服务器IP不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }
}