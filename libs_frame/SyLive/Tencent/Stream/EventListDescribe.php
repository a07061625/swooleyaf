<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 8:35
 */
namespace SyLive\Tencent\Stream;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询推断流事件
 *
 * @package SyLive\Tencent\Stream
 */
class EventListDescribe extends BaseTencent
{
    /**
     * 开始时间
     *
     * @var int
     */
    private $StartTime = 0;
    /**
     * 结束时间
     *
     * @var int
     */
    private $EndTime = 0;
    /**
     * 推流路径
     *
     * @var string
     */
    private $AppName = '';
    /**
     * 推流域名
     *
     * @var string
     */
    private $DomainName = '';
    /**
     * 流名称
     *
     * @var string
     */
    private $StreamName = '';
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
     * 过滤标识
     *
     * @var int
     */
    private $IsFilter = 0;
    /**
     * 精确查询标识
     *
     * @var int
     */
    private $IsStrict = 0;
    /**
     * 结束时间排序标识
     *
     * @var int
     */
    private $IsAsc = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveStreamEventList';
        $this->reqData['AppName'] = 'live';
        $this->reqData['PageNum'] = 1;
        $this->reqData['PageSize'] = 10;
        $this->reqData['IsFilter'] = 0;
        $this->reqData['IsStrict'] = 0;
        $this->reqData['IsAsc'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param int $startTime
     * @param int $endTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setTime(int $startTime, int $endTime)
    {
        if ($startTime < 1262275200) {
            throw new TencentException('开始时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        } elseif ($endTime < $startTime) {
            throw new TencentException('结束时间不能小于开始时间', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        } elseif (($endTime - $startTime) > 2592000) {
            throw new TencentException('结束时间不能超过开始时间30天', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['StartTime'] = date('Y-m-dTH:i:sZ', $startTime);
        $this->reqData['EndTime'] = date('Y-m-dTH:i:sZ', $endTime);
    }

    /**
     * @param string $appName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setAppName(string $appName)
    {
        if (strlen($appName) > 0) {
            $this->reqData['AppName'] = $appName;
        } else {
            throw new TencentException('推流路径不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $domainName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setDomainName(string $domainName)
    {
        if (strlen($domainName) > 0) {
            $this->reqData['DomainName'] = $domainName;
        } else {
            throw new TencentException('推流域名不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $streamName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setStreamName(string $streamName)
    {
        if (strlen($streamName) > 0) {
            $this->reqData['StreamName'] = $streamName;
        } else {
            throw new TencentException('流名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageNum
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageNum(int $pageNum)
    {
        if ($pageNum > 0) {
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
        if (($pageSize >= 1) && ($pageSize <= 100)) {
            $this->reqData['PageSize'] = $pageSize;
        } else {
            throw new TencentException('每页个数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $isFilter
     *
     * @throws \SyException\Live\TencentException
     */
    public function setIsFilter(int $isFilter)
    {
        if (in_array($isFilter, [0, 1])) {
            $this->reqData['IsFilter'] = $isFilter;
        } else {
            throw new TencentException('过滤标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $isStrict
     *
     * @throws \SyException\Live\TencentException
     */
    public function setIsStrict(int $isStrict)
    {
        if (in_array($isStrict, [0, 1])) {
            $this->reqData['IsStrict'] = $isStrict;
        } else {
            throw new TencentException('精确查询标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $isAsc
     *
     * @throws \SyException\Live\TencentException
     */
    public function setIsAsc(int $isAsc)
    {
        if (in_array($isAsc, [0, 1])) {
            $this->reqData['IsAsc'] = $isAsc;
        } else {
            throw new TencentException('结束时间排序标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['StartTime'])) {
            throw new TencentException('开始时间不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
