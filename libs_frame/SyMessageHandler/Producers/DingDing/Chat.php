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
 * Class Chat
 * @package SyMessageHandler\Producers\DingDing
 */
class Chat extends BaseDingDing implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CHAT);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkAgentTag',
            4 => 'checkChatId',
            5 => 'checkMessageType',
            6 => 'checkMessageData',
        ];
    }

    private function __clone()
    {
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
