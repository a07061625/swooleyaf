<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 16:09
 */

namespace SyMap\Tencent;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Map\TencentMapException;
use SyMap\MapBaseTencent;

class IpLocation extends MapBaseTencent
{
    /**
     * IP
     *
     * @var string
     */
    private $ip = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://apis.map.qq.com/ws/location/v1/ip';
        $this->rspDataKey = 'result';
    }

    public function __clone()
    {
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setIp(string $ip)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $ip) > 0) {
            $this->reqData['ip'] = $ip;
        } else {
            throw new TencentMapException('ip不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['ip'])) {
            throw new TencentMapException('ip不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
