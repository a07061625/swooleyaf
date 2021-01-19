<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-14
 * Time: 下午1:42
 */

namespace SyMap\GaoDe;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Map\GaoDeMapException;
use SyMap\MapBaseGaoDe;

/**
 * IP定位
 *
 * @package Map\GaoDe
 */
class IpLocation extends MapBaseGaoDe
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
        $this->serviceUri = '/ip';
    }

    /**
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setIp(string $ip)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $ip) > 0) {
            $this->reqData['ip'] = $ip;
        } else {
            throw new GaoDeMapException('ip不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['ip'])) {
            throw new GaoDeMapException('ip不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
