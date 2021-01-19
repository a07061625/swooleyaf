<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 9:39
 */

namespace SyMap\BaiDu;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Map\BaiduMapException;
use SyMap\MapBaseBaiDu;

class IpLocation extends MapBaseBaiDu
{
    const COORD_TYPE_BD_MC = ''; //坐标类型-百度墨卡托
    const COORD_TYPE_BD = 'bd09ll'; //坐标类型-百度
    const COORD_TYPE_GCJ = 'gcj02'; //坐标类型-国测局

    /**
     * IP
     *
     * @var string
     */
    private $ip = '';
    /**
     * 返回坐标类型
     *
     * @var string
     */
    private $returnCoordType = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/location/ip';
    }

    public function __clone()
    {
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setIp(string $ip)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $ip) > 0) {
            $this->reqData['ip'] = $ip;
        } else {
            throw new BaiduMapException('ip不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setReturnCoordType(string $returnCoordType)
    {
        if (\in_array($returnCoordType, [self::COORD_TYPE_BD_MC, self::COORD_TYPE_BD, self::COORD_TYPE_GCJ], true)) {
            $this->reqData['coor'] = $returnCoordType;
        } else {
            throw new BaiduMapException('返回坐标类型不支持', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['ip'])) {
            throw new BaiduMapException('ip不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
