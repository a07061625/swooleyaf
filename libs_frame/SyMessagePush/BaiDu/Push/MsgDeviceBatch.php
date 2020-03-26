<?php
/**
 * 推送消息到给定的一组设备
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 18:53
 */
namespace SyMessagePush\BaiDu\Push;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;
use SyTool\Tool;

class MsgDeviceBatch extends PushBaseBaiDu
{
    /**
     * 设备ID列表
     * @var array
     */
    private $channel_ids = [];
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
     * 分类主题标识
     * @var string
     */
    private $topic_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/push/batch_device';
        $this->reqData['msg_type'] = 0;
        $this->reqData['msg_expires'] = 86400;
    }

    private function __clone()
    {
    }

    /**
     * @param array $channelIds
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setChannelIds(array $channelIds)
    {
        $needNum = count($channelIds);
        if ($needNum == 0) {
            throw new BaiDuPushException('设备ID列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        } elseif ($needNum > 10000) {
            throw new BaiDuPushException('设备ID列表不能超过10000个', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->channel_ids = [];
        foreach ($channelIds as $eChannelId) {
            if (strlen($eChannelId) > 0) {
                $this->channel_ids[$eChannelId] = 1;
            }
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
        if (($msgExpires >= 1) && ($msgExpires <= 86400)) {
            $this->reqData['msg_expires'] = $msgExpires;
        } else {
            throw new BaiDuPushException('消息过期时间不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $topicId
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setTopicId(string $topicId)
    {
        if (ctype_alnum($topicId) && (strlen($topicId) <= 128)) {
            $this->reqData['topic_id'] = $topicId;
        } else {
            throw new BaiDuPushException('分类主题标识不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['msg'])) {
            throw new BaiDuPushException('消息内容不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (empty($this->channel_ids)) {
            throw new BaiDuPushException('设备ID列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['channel_ids'] = Tool::jsonEncode(array_keys($this->channel_ids), JSON_UNESCAPED_UNICODE);
        return $this->getContent();
    }
}
