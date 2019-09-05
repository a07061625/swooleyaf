<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-14
 * Time: 下午1:42
 */
namespace Map\GaoDe;

use SyConstant\ErrorCode;
use SyException\Map\GaoDeMapException;
use Map\MapBaseGaoDe;

/**
 * IP定位
 * @package Map\GaoDe
 */
class IpLocation extends MapBaseGaoDe
{
    /**
     * IP
     * @var string
     */
    private $ip = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/ip';
    }

    /**
     * @param string $ip
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setIp(string $ip)
    {
        if (preg_match('/^(\.(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])){4}$/', '.' . $ip) > 0) {
            $this->reqData['ip'] = $ip;
        } else {
            throw new GaoDeMapException('ip不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['ip'])) {
            throw new GaoDeMapException('ip不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
