<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 16:09
 */
namespace Map\Tencent;

use Constant\ErrorCode;
use Exception\Map\TencentMapException;
use Map\MapBaseTencent;

class IpLocation extends MapBaseTencent {
    /**
     * IP
     * @var string
     */
    private $ip = '';

    public function __construct(){
        parent::__construct();
        $this->serviceUrl = 'https://apis.map.qq.com/ws/location/v1/ip';
        $this->rspDataKey = 'result';
    }

    public function __clone(){
    }

    /**
     * @param string $ip
     * @throws \Exception\Map\TencentMapException
     */
    public function setIp(string $ip) {
        if (preg_match('/^(\.(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])){4}$/', '.' . $ip) > 0) {
            $this->reqData['ip'] = $ip;
        } else {
            throw new TencentMapException('ip不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array {
        if(!isset($this->reqData['ip'])){
            throw new TencentMapException('ip不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        return $this->getContent();
    }
}