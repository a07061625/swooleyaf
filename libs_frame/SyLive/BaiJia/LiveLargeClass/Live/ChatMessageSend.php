<?php
/**
 * 发送聊天消息
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 10:44
 */
namespace SyLive\BaiJia\LiveLargeClass\Live;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;
use SyTool\Tool;

/**
 * Class ChatMessageSend
 * @package SyLive\BaiJia\LiveLargeClass\Live
 */
class ChatMessageSend extends BaseBaiJia
{
    /**
     * 消息列表
     * @var array
     */
    private $message_list = [];

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live/sendChatMessage';
        $this->message_list = [];
    }

    private function __clone()
    {
    }

    /**
     * @param \SyLive\BaiJia\LiveLargeClass\Live\ChatMessage $message
     * @throws \SyException\Live\BaiJiaException
     */
    public function addMessage(ChatMessage $message)
    {
        if (count($this->message_list) >= 10) {
            throw new BaiJiaException('消息不能超过10个', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->message_list[] = $message->getData();
    }

    public function getDetail() : array
    {
        if (empty($this->message_list)) {
            throw new BaiJiaException('消息列表不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->reqData['message_list'] = Tool::jsonEncode($this->message_list, JSON_UNESCAPED_UNICODE);
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
