<?php
/**
 * 发送聊天消息
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 10:44
 */
namespace LiveEducation\BJY\Live\LargeClass\Live;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;
use SyTool\Tool;

/**
 * Class ChatMessageSend
 * @package LiveEducation\BJY\Live\LargeClass\Live
 */
class ChatMessageSend extends BaseBJY
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
     * @param \LiveEducation\BJY\Live\LargeClass\Live\ChatMessage $message
     * @throws \SyException\LiveEducation\BJYException
     */
    public function addMessage(ChatMessage $message)
    {
        if (count($this->message_list) >= 10) {
            throw new BJYException('消息不能超过10个', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }

        $this->message_list[] = $message->getData();
    }

    public function getDetail() : array
    {
        if (empty($this->message_list)) {
            throw new BJYException('消息列表不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['message_list'] = Tool::jsonEncode($this->message_list, JSON_UNESCAPED_UNICODE);
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
