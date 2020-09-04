<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 13:39
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询直播转码统计信息
 *
 * @package SyLive\Tencent\Statics
 */
class LiveTranscodeDetailInfoDescribe extends BaseTencent
{
    /**
     * 推流域名
     *
     * @var string
     */
    private $PushDomain = '';
    /**
     * 流名称
     *
     * @var string
     */
    private $StreamName = '';
    /**
     * 查询时间
     *
     * @var int
     */
    private $DayTime = 0;
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
    /**
     * 起始时间
     *
     * @var int
     */
    private $StartDayTime = 0;
    /**
     * 结束时间
     *
     * @var int
     */
    private $EndDayTime = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveTranscodeDetailInfo';
        $this->reqData['PageNum'] = 1;
        $this->reqData['PageSize'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @param string $pushDomain
     */
    public function setPushDomain(string $pushDomain)
    {
        if (strlen($pushDomain) > 0) {
            $this->reqData['PushDomain'] = $pushDomain;
        }
    }

    /**
     * @param string $streamName
     */
    public function setStreamName(string $streamName)
    {
        if (strlen($streamName) > 0) {
            $this->reqData['StreamName'] = $streamName;
        }
    }

    /**
     * @param int $dayTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setDayTime(int $dayTime)
    {
        if ($dayTime > 1262275200) {
            $this->reqData['DayTime'] = date('Ymd', $dayTime);
        } else {
            throw new TencentException('查询时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageNum
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageNum(int $pageNum)
    {
        if (($pageNum > 0) && ($pageNum <= 100)) {
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
        if (($pageSize >= 10) && ($pageSize <= 1000)) {
            $this->reqData['PageSize'] = $pageSize;
        } else {
            throw new TencentException('每页个数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $startDayTime
     * @param int $endDayTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setRangeDayTime(int $startDayTime, int $endDayTime)
    {
        if ($startDayTime < 1262275200) {
            throw new TencentException('起始时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        } elseif ($endDayTime < $startDayTime) {
            throw new TencentException('结束时间不能小于起始时间', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['StartDayTime'] = date('Ymd', $startDayTime);
        $this->reqData['EndDayTime'] = date('Ymd', $endDayTime);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['DayTime']) && !isset($this->reqData['StartDayTime'])) {
            throw new TencentException('开始时间和查询时间不能同时为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
