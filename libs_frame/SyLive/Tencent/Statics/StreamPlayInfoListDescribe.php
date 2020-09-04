<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 12:42
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询流的播放信息列表
 *
 * @package SyLive\Tencent\Statics
 */
class StreamPlayInfoListDescribe extends BaseTencent
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
     * 播放域名
     *
     * @var string
     */
    private $PlayDomain = '';
    /**
     * 流名称
     *
     * @var string
     */
    private $StreamName = '';
    /**
     * 推流路径
     *
     * @var string
     */
    private $AppName = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeStreamPlayInfoList';
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
        }
        $this->reqData['StartTime'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['EndTime'] = date('Y-m-d H:i:s', $endTime);
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
     * @param string $streamName
     */
    public function setStreamName(string $streamName)
    {
        if (strlen($streamName) > 0) {
            $this->reqData['StreamName'] = $streamName;
        }
    }

    /**
     * @param string $appName
     */
    public function setAppName(string $appName)
    {
        if (strlen($appName) > 0) {
            $this->reqData['AppName'] = $appName;
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
