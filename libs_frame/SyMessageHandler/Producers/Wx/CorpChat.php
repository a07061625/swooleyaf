<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\IProducer;
use SyMessageHandler\Producers\BaseWxCorp;

/**
 * Class CorpChat
 * @package SyMessageHandler\Producers\Wx
 */
class CorpChat extends BaseWxCorp implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_CHAT);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkAgentTag',
            4 => 'checkChatId',
            5 => 'checkMessageType',
            6 => 'checkMessageData',
            7 => 'checkSafe',
        ];
    }

    private function __clone()
    {
    }

    private function checkChatId(array $data) : string
    {
        $chatId = $data['chat_id'] ?? '';
        if (!is_string($chatId)) {
            return '群id不合法';
        } elseif (!ctype_alnum($chatId)) {
            return '群id不合法';
        }

        $this->msgData['receivers'] = [
            0 => $chatId,
        ];
        return '';
    }

    private function checkSafe(array $data) : string
    {
        $safe = $data['safe'] ?? 0;
        if (!is_int($safe)) {
            return '保密消息标识不合法';
        } elseif (!in_array($safe, [0, 1])) {
            return '保密消息标识不合法';
        }

        $this->msgData['ext_data']['safe'] = $safe;
        return '';
    }
}
