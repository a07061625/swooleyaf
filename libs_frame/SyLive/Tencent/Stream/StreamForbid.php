<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 8:33
 */
namespace SyLive\Tencent\Stream;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 禁推直播流
 *
 * @package SyLive\Tencent\Stream
 */
class StreamForbid extends BaseTencent
{
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
     * 恢复时间
     *
     * @var int
     */
    private $ResumeTime = 0;
    /**
     * 禁推原因
     *
     * @var string
     */
    private $Reason = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'ForbidLiveStream';
        $this->reqData['AppName'] = 'live';
        $this->reqData['Reason'] = '';
    }

    private function __clone()
    {
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
     * @param int $resumeTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setResumeTime(int $resumeTime)
    {
        if (($resumeTime > 0) && ($resumeTime <= 7776000)) {
            $needTime = time() + $resumeTime;
            $this->reqData['ResumeTime'] = date('Y-m-dTH:i:sZ', $needTime);
        } else {
            throw new TencentException('恢复时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $reason
     */
    public function setReason(string $reason)
    {
        $this->reqData['Reason'] = trim($reason);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['DomainName'])) {
            throw new TencentException('推流域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['StreamName'])) {
            throw new TencentException('流名称不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (strlen($this->reqData['Reason']) == 0) {
            throw new TencentException('禁推原因不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
