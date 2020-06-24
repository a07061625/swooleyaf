<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\DingDing;

use SyConstant\Project;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class Conversation
 * @package SyMessageHandler\Producers\DingDing
 */
class Conversation extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData) : string
    {
        $appId = $msgData['app_id'] ?? '';
        if (!is_string($appId)) {
            return '应用ID不合法';
        } elseif (strlen($appId) == 0) {
            return '应用ID不能为空';
        }
        $agentTag = $msgData['agent_tag'] ?? '';
        if (!is_string($agentTag)) {
            return '应用标识不合法';
        } elseif (strlen($agentTag) == 0) {
            return '应用标识不能为空';
        }
        $sender = $msgData['sender'] ?? '';
        if (!is_string($sender)) {
            return '发送者不合法';
        } elseif (!ctype_alnum($sender)) {
            return '发送者不合法';
        }
        $chatId = $msgData['chat_id'] ?? '';
        if (!is_string($chatId)) {
            return '会话ID不合法';
        } elseif (!ctype_alnum($chatId)) {
            return '会话ID不合法';
        }
        $messageType = $msgData['message_type'] ?? '';
        if (!is_string($messageType)) {
            return '消息类型不合法';
        } elseif (strlen($messageType) == 0) {
            return '消息类型不能为空';
        }
        $messageData = $msgData['message_data'] ?? [];
        if (!is_array($messageData)) {
            return '消息数据不合法';
        } elseif (empty($messageData)) {
            return '消息数据不能为空';
        }

        $this->msgData['app_id'] = $appId;
        $this->msgData['senders'] = [
            0 => $sender,
        ];
        $this->msgData['receivers'] = [
            0 => $chatId,
        ];
        $this->msgData['template_params']['type'] = $messageType;
        $this->msgData['template_params']['data'] = $messageData;
        $this->msgData['ext_data']['agent_tag'] = $agentTag;
        return '';
    }
}
