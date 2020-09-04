<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 8:35
 */
namespace SyLive\Tencent\Record;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 创建录制任务
 *
 * @package SyLive\Tencent\Record
 */
class TaskCreate extends BaseTencent
{
    /**
     * 流名称
     *
     * @var string
     */
    private $StreamName = '';
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
     * 推流类型
     *
     * @var int
     */
    private $StreamType = 0;
    /**
     * 录制模板ID
     *
     * @var int
     */
    private $TemplateId = 0;
    /**
     * 扩展字段
     *
     * @var string
     */
    private $Extension = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CreateRecordTask';
        $this->reqData['StreamType'] = 0;
        $this->reqData['Extension'] = '';
    }

    private function __clone()
    {
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
     * @param int $startTime
     * @param int $endTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setTime(int $startTime, int $endTime)
    {
        $nowTime = time();
        if ($startTime < $nowTime) {
            throw new TencentException('开始时间不能小于当前时间', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        } elseif (($startTime - $nowTime) > 86400) {
            throw new TencentException('开始时间不能超过当前时间1天', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        } elseif ($endTime < $startTime) {
            throw new TencentException('结束时间不能小于开始时间', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        } elseif (($endTime - $nowTime) > 86400) {
            throw new TencentException('结束时间不能超过当前时间1天', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['StartTime'] = $startTime;
        $this->reqData['EndTime'] = $endTime;
    }

    /**
     * @param int $streamType
     *
     * @throws \SyException\Live\TencentException
     */
    public function setStreamType(int $streamType)
    {
        if (in_array($streamType, [0, 1])) {
            $this->reqData['StreamType'] = $streamType;
        } else {
            throw new TencentException('推流类型不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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
     * @param string $extension
     */
    public function setExtension(string $extension)
    {
        $this->reqData['Extension'] = trim($extension);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['StreamName'])) {
            throw new TencentException('流名称不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['DomainName'])) {
            throw new TencentException('推流域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['AppName'])) {
            throw new TencentException('推流路径不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['EndTime'])) {
            throw new TencentException('结束时间不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
