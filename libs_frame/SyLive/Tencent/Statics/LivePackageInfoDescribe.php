<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 16:03
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询直播套餐包信息
 *
 * @package SyLive\Tencent\Statics
 */
class LivePackageInfoDescribe extends BaseTencent
{
    /**
     * 包类型
     *
     * @var int
     */
    private $PackageType = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLivePackageInfo';
    }

    private function __clone()
    {
    }

    /**
     * @param int $packageType
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPackageType(int $packageType)
    {
        if (in_array($packageType, [0, 1])) {
            $this->reqData['PackageType'] = $packageType;
        } else {
            throw new TencentException('包类型不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['PackageType'])) {
            throw new TencentException('包类型不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
