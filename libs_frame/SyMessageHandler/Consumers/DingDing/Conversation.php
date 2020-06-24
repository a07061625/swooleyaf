<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\DingDing;

use DingDing\Corp\Message\ConversationSend;
use SyConstant\Project;
use SyMessageHandler\ConsumerBase;
use SyMessageHandler\IConsumer;

/**
 * Class Conversation
 * @package SyMessageHandler\Consumers\DingDing
 */
class Conversation extends ConsumerBase implements IConsumer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $conversationSend = new ConversationSend($msgData['app_id'], $msgData['ext_data']['agent_tag']);
        $conversationSend->setSender($msgData['senders'][0]);
        $conversationSend->setCid($msgData['receivers'][0]);
        $conversationSend->setMsgData($msgData['template_params']['type'], $msgData['template_params']['data']);
        $sendRes = $conversationSend->getDetail();
        $handleRes['code'] = $sendRes['code'];
        if ($sendRes['code'] > 0) {
            $handleRes['msg'] = $sendRes['data'];
        } else {
            $handleRes['data'] = $sendRes['message'];
        }

        return $handleRes;
    }
}
