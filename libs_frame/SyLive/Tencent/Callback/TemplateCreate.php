<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 17:36
 */
namespace SyLive\Tencent\Callback;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 创建回调模板
 * @package SyLive\Tencent\Callback
 */
class TemplateCreate extends BaseTencent
{
    /**
     * 模板名称
     * @var string
     */
    private $TemplateName = '';
    /**
     * 描述信息
     * @var string
     */
    private $Description = '';
    /**
     * 开播回调URL
     * @var string
     */
    private $StreamBeginNotifyUrl = '';
    /**
     * 断流回调URL
     * @var string
     */
    private $StreamEndNotifyUrl = '';
    /**
     * 录制回调URL
     * @var string
     */
    private $RecordNotifyUrl = '';
    /**
     * 截图回调URL
     * @var string
     */
    private $SnapshotNotifyUrl = '';
    /**
     * 鉴黄回调URL
     * @var string
     */
    private $PornCensorshipNotifyUrl = '';
    /**
     * 回调Key
     * @var string
     */
    private $CallbackKey = '';
    /**
     * 混流回调URL
     * @var string
     */
    private $StreamMixNotifyUrl = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CreateLiveCallbackTemplate';
    }

    private function __clone()
    {
    }

    /**
     * @param string $templateName
     * @throws \SyException\Live\TencentException
     */
    public function setTemplateName(string $templateName)
    {
        $length = strlen($templateName);
        if (($length > 0) && ($length <= 255)) {
            $this->reqData['TemplateName'] = $templateName;
        } else {
            throw new TencentException('模板名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->reqData['Description'] = trim($description);
    }

    /**
     * @param string $streamBeginNotifyUrl
     * @throws \SyException\Live\TencentException
     */
    public function setStreamBeginNotifyUrl(string $streamBeginNotifyUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $streamBeginNotifyUrl) > 0) {
            $this->reqData['StreamBeginNotifyUrl'] = $streamBeginNotifyUrl;
        } else {
            throw new TencentException('开播回调URL不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $streamEndNotifyUrl
     * @throws \SyException\Live\TencentException
     */
    public function setStreamEndNotifyUrl(string $streamEndNotifyUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $streamEndNotifyUrl) > 0) {
            $this->reqData['StreamEndNotifyUrl'] = $streamEndNotifyUrl;
        } else {
            throw new TencentException('断流回调URL不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $recordNotifyUrl
     * @throws \SyException\Live\TencentException
     */
    public function setRecordNotifyUrl(string $recordNotifyUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $recordNotifyUrl) > 0) {
            $this->reqData['RecordNotifyUrl'] = $recordNotifyUrl;
        } else {
            throw new TencentException('录制回调URL不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $snapshotNotifyUrl
     * @throws \SyException\Live\TencentException
     */
    public function setSnapshotNotifyUrl(string $snapshotNotifyUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $snapshotNotifyUrl) > 0) {
            $this->reqData['SnapshotNotifyUrl'] = $snapshotNotifyUrl;
        } else {
            throw new TencentException('截图回调URL不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $pornCensorshipNotifyUrl
     * @throws \SyException\Live\TencentException
     */
    public function setPornCensorshipNotifyUrl(string $pornCensorshipNotifyUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $pornCensorshipNotifyUrl) > 0) {
            $this->reqData['PornCensorshipNotifyUrl'] = $pornCensorshipNotifyUrl;
        } else {
            throw new TencentException('鉴黄回调URL不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $callbackKey
     * @throws \SyException\Live\TencentException
     */
    public function setCallbackKey(string $callbackKey)
    {
        if (strlen($callbackKey) > 0) {
            $this->reqData['CallbackKey'] = $callbackKey;
        } else {
            throw new TencentException('回调Key不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $streamMixNotifyUrl
     * @throws \SyException\Live\TencentException
     */
    public function setStreamMixNotifyUrl(string $streamMixNotifyUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $streamMixNotifyUrl) > 0) {
            $this->reqData['StreamMixNotifyUrl'] = $streamMixNotifyUrl;
        } else {
            throw new TencentException('混流回调URL不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['TemplateName'])) {
            throw new TencentException('模板名称不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
