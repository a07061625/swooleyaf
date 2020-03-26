<?php
/**
 * 推送消息到单台设备
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 18:53
 */
namespace SyMessagePush\BaiDu\Push;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;
use SyTool\Tool;

class MsgDeviceSingle extends PushBaseBaiDu
{
    /**
     * 设备ID
     * @var string
     */
    private $channel_id = '';
    /**
     * 消息类型 0:消息 1:通知
     * @var int
     */
    private $msg_type = 0;
    /**
     * 消息内容
     * @var string
     */
    private $msg = '';
    /**
     * 消息过期时间
     * @var int
     */
    private $msg_expires = 0;
    /**
     * 部署状态 1:开发 2:生产
     * @var int
     */
    private $deploy_status = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/push/single_device';
        $this->reqData['msg_type'] = 0;
        $this->reqData['msg_expires'] = 18000;
        $this->reqData['deploy_status'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @param string $channelId
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setChannelId(string $channelId)
    {
        if (strlen($channelId) > 0) {
            $this->reqData['channel_id'] = $channelId;
        } else {
            throw new BaiDuPushException('设备ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $msgType
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setMsgType(int $msgType)
    {
        if (in_array($msgType, [0, 1])) {
            $this->reqData['msg_type'] = $msgType;
        } else {
            throw new BaiDuPushException('消息类型不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param array $msg
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setMsg(array $msg)
    {
        if (empty($msg)) {
            throw new BaiDuPushException('消息内容不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['msg'] = Tool::jsonEncode($msg, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param int $msgExpires
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setMsgExpires(int $msgExpires)
    {
        if (($msgExpires >= 0) && ($msgExpires <= 604800)) {
            $this->reqData['msg_expires'] = $msgExpires;
        } else {
            throw new BaiDuPushException('消息过期时间不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $deployStatus
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setDeployStatus(int $deployStatus)
    {
        if (in_array($deployStatus, [1, 2])) {
            $this->reqData['deploy_status'] = $deployStatus;
        } else {
            throw new BaiDuPushException('部署状态不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['channel_id'])) {
            throw new BaiDuPushException('设备ID不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['msg'])) {
            throw new BaiDuPushException('消息内容不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
