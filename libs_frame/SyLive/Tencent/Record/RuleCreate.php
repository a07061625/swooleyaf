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
 * 创建录制规则
 *
 * @package SyLive\Tencent\Record
 */
class RuleCreate extends BaseTencent
{
    /**
     * 推流域名
     *
     * @var string
     */
    private $DomainName = '';
    /**
     * 模板ID
     *
     * @var int
     */
    private $TemplateId = 0;
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
        $this->reqHeader['X-TC-Action'] = 'CreateLiveRecordRule';
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
        if (!isset($this->reqData['TemplateId'])) {
            throw new TencentException('模板ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
