<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:27
 */
namespace Map;

use Constant\ErrorCode;
use Exception\Map\BaiduMapException;

class ConfigBaiDu {
    /**
     * 开发密钥
     * @var string
     */
    private $ak = '';
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
    public function getAk() : string {
        return $this->ak;
    }

    /**
     * @param string $ak
     * @throws \Exception\Map\BaiduMapException
     */
    public function setAk(string $ak){
        if(ctype_alnum($ak) && (strlen($ak) == 32)){
            $this->ak = $ak;
        } else {
            throw new BaiduMapException('密钥不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
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
     * @throws \Exception\Map\BaiduMapException
     */
    public function setServerIp(string $serverIp){
        if(preg_match('/^(\.(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])){4}$/', '.' . $serverIp) > 0){
            $this->serverIp = $serverIp;
        } else {
            throw new BaiduMapException('服务器IP不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }
}