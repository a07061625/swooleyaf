<?php
/**
 * 消息分组推送
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 14:49
 */
namespace SyMessagePush\JPush\Push;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\PushBase;
use SyMessagePush\PushUtilJPush;
use SyTool\Tool;

class MessageGroupPush extends PushBase
{
    /**
     * 推送标识符
     * @var string
     */
    private $cid = '';
    /**
     * 平台类型
     * @var array
     */
    private $platform = [];
    /**
     * 接收方
     * @var array
     */
    private $audience = [];
    /**
     * 通知内容
     * @var array
     */
    private $notification = [];
    /**
     * 消息内容
     * @var array
     */
    private $message = [];
    /**
     * 短信补充内容
     * @var array
     */
    private $sms_message = [];
    /**
     * 推送参数
     * @var array
     */
    private $options = [];

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'group');
        $this->serviceUri = '/v3/grouppush';
    }

    private function __clone()
    {
    }

    /**
     * @param string $cid
     * @throws \SyException\MessagePush\JPushException
     */
    public function setCid(string $cid)
    {
        if (strlen($cid) > 0) {
            $this->reqData['cid'] = $cid;
        } else {
            throw new JPushException('推送标识符不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param array $platforms
     */
    public function setPlatform(array $platforms)
    {
        foreach ($platforms as $ePlatform) {
            if (isset(self::$totalPlatFormType[$ePlatform])) {
                $this->platform[$ePlatform] = 1;
            }
        }
    }

    /**
     * @param array $audience
     * @throws \SyException\MessagePush\JPushException
     */
    public function setAudience(array $audience)
    {
        if (empty($audience)) {
            throw new JPushException('接收方不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['audience'] = $audience;
    }

    /**
     * @param array $notification
     * @throws \SyException\MessagePush\JPushException
     */
    public function setNotification(array $notification)
    {
        if (empty($notification)) {
            throw new JPushException('通知内容不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['notification'] = $notification;
    }

    /**
     * @param array $message
     * @throws \SyException\MessagePush\JPushException
     */
    public function setMessage(array $message)
    {
        if (empty($message)) {
            throw new JPushException('消息内容不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['message'] = $message;
    }

    /**
     * @param array $smsMessage
     * @throws \SyException\MessagePush\JPushException
     */
    public function setSmsMessage(array $smsMessage)
    {
        if (empty($smsMessage)) {
            throw new JPushException('短信补充内容不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['sms_message'] = $smsMessage;
    }

    /**
     * @param array $options
     * @throws \SyException\MessagePush\JPushException
     */
    public function setOptions(array $options)
    {
        if (empty($options)) {
            throw new JPushException('推送参数不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['options'] = $options;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['audience'])) {
            throw new JPushException('接收方不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if ((!isset($this->reqData['notification'])) && !isset($this->reqData['message'])) {
            throw new JPushException('通知内容和消息内容不能同时为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['platform'] = empty($this->platform) ? self::PLATFORM_TYPE_ALL : array_keys($this->platform);

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->getContent();
    }
}
