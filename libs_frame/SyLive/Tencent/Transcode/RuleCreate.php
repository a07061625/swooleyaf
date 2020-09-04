<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 22:10
 */
namespace SyLive\Tencent\Transcode;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 创建转码规则
 *
 * @package SyLive\Tencent\Transcode
 */
class RuleCreate extends BaseTencent
{
    /**
     * 播放域名
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
    /**
     * 模板ID
     *
     * @var int
     */
    private $TemplateId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CreateLiveTranscodeRule';
        $this->reqData['AppName'] = '';
        $this->reqData['StreamName'] = '';
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
            throw new TencentException('播放域名不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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

    /**
     * @param int $templateId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setTemplateId(int $templateId)
    {
        if ($templateId > 0) {
            $this->reqData['TemplateId'] = $templateId;
        } else {
            throw new TencentException('模板ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['DomainName'])) {
            throw new TencentException('播放域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['TemplateId'])) {
            throw new TencentException('模板ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
