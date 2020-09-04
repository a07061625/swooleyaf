<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 15:52
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询某个时间点所有流的下行播放数据
 *
 * @package SyLive\Tencent\Statics
 */
class AllStreamPlayInfoListDescribe extends BaseTencent
{
    /**
     * 查询时间
     *
     * @var int
     */
    private $QueryTime = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeAllStreamPlayInfoList';
    }

    private function __clone()
    {
    }

    /**
     * @param int $queryTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setQueryTime(int $queryTime)
    {
        if ($queryTime >= 1262275200) {
            $this->reqData['QueryTime'] = date('Y-m-d H:i:s', $queryTime);
        } else {
            throw new TencentException('查询时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['QueryTime'])) {
            throw new TencentException('查询时间不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
