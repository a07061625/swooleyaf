<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 15:13
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询所有流的流量数据
 *
 * @package SyLive\Tencent\Statics
 */
class StreamDayPlayInfoListDescribe extends BaseTencent
{
    /**
     * 查询时间
     *
     * @var int
     */
    private $DayTime = 0;
    /**
     * 播放域名
     *
     * @var string
     */
    private $PlayDomain = '';
    /**
     * 页数,默认1
     *
     * @var int
     */
    private $PageNum = 0;
    /**
     * 每页个数,默认20
     *
     * @var int
     */
    private $PageSize = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeStreamDayPlayInfoList';
        $this->reqData['PageNum'] = 1;
        $this->reqData['PageSize'] = 1000;
    }

    private function __clone()
    {
    }

    /**
     * @param int $dayTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setDayTime(int $dayTime)
    {
        if ($dayTime > 1262275200) {
            $this->reqData['DayTime'] = date('Y-m-d', $dayTime);
        } else {
            throw new TencentException('查询时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $playDomain
     */
    public function setPlayDomain(string $playDomain)
    {
        if (strlen($playDomain) > 0) {
            $this->reqData['PlayDomain'] = $playDomain;
        }
    }

    /**
     * @param int $pageNum
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageNum(int $pageNum)
    {
        if (($pageNum > 0) && ($pageNum <= 1000)) {
            $this->reqData['PageNum'] = $pageNum;
        } else {
            throw new TencentException('页数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize >= 100) && ($pageSize <= 1000)) {
            $this->reqData['PageSize'] = $pageSize;
        } else {
            throw new TencentException('每页个数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['DayTime'])) {
            throw new TencentException('查询时间不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
