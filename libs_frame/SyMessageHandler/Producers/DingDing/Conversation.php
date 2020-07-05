<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\DingDing;

use SyConstant\ProjectBase;
use SyMessageHandler\IProducer;
use SyMessageHandler\Producers\BaseDingDing;

/**
 * Class Conversation
 * @package SyMessageHandler\Producers\DingDing
 */
class Conversation extends BaseDingDing implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkAgentTag',
            4 => 'checkSender',
            5 => 'checkChatId',
            6 => 'checkMessageType',
            7 => 'checkMessageData',
        ];
    }

    private function __clone()
    {
    }

    private function checkSender(array $data) : string
    {
        $sender = $data['sender'] ?? '';
        if (!is_string($sender)) {
            return '发送者不合法';
        } elseif (!ctype_alnum($sender)) {
            return '发送者不合法';
        }

        $this->msgData['senders'] = [
            0 => $sender,
        ];
        return '';
    }

    private function checkChatId(array $data) : string
    {
        $chatId = $data['chat_id'] ?? '';
        if (!is_string($chatId)) {
            return '会话ID不合法';
        } elseif (!ctype_alnum($chatId)) {
            return '会话ID不合法';
        }

        $this->msgData['receivers'] = [
            0 => $chatId,
        ];
        return '';
    }
}
