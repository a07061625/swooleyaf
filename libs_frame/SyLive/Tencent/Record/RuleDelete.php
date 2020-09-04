<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 8:34
 */
namespace SyLive\Tencent\Record;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 删除录制规则
 *
 * @package SyLive\Tencent\Record
 */
class RuleDelete extends BaseTencent
{
    /**
     * 推流域名
     *
     * @var string
     */
    private $DomainName = '';
    /**
     * 推流路径
     *
     * @var string
     */
    private $AppName = '';
    /**
     * 流名称
     *
     * @var string
     */
    private $StreamName = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DeleteLiveRecordRule';
        $this->reqData['AppName'] = 'live';
    }

    private function __clone()
    {
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
     * @param string $appName
     */
    public function setAppName(string $appName)
    {
        $this->reqData['AppName'] = trim($appName);
    }

    /**
     * @param string $streamName
     */
    public function setStreamName(string $streamName)
    {
        $this->reqData['StreamName'] = trim($streamName);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['DomainName'])) {
            throw new TencentException('推流域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
