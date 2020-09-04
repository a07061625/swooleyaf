<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 8:34
 */
namespace SyLive\Tencent\Delay;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 延迟播放
 *
 * @package SyLive\Tencent\Delay
 */
class DelayAdd extends BaseTencent
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
     * 延播时间,单位为秒
     *
     * @var int
     */
    private $DelayTime = 0;
    /**
     * 过期时间
     *
     * @var int
     */
    private $ExpireTime = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'AddDelayLiveStream';
        $this->reqData['AppName'] = 'live';
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
     * @param int $delayTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setDelayTime(int $delayTime)
    {
        if (($delayTime > 0) && ($delayTime <= 600)) {
            $this->reqData['DelayTime'] = $delayTime;
        } else {
            throw new TencentException('延播时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $expireTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setExpireTime(int $expireTime)
    {
        if (($expireTime > 0) && ($expireTime <= 604800)) {
            $needTime = time() + $expireTime;
            $this->reqData['ExpireTime'] = date('Y-m-dTH:i:sZ', $needTime);
        } else {
            throw new TencentException('过期时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['DomainName'])) {
            throw new TencentException('推流域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['StreamName'])) {
            throw new TencentException('流名称不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['DelayTime'])) {
            throw new TencentException('延播时间不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
