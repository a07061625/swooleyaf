<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\DingDing;

use DingDing\Corp\Chat\ChatSend;
use SyConstant\Project;
use SyMessageHandler\ConsumerBase;
use SyMessageHandler\IConsumer;

/**
 * Class Chat
 * @package SyMessageHandler\Consumers\DingDing
 */
class Chat extends ConsumerBase implements IConsumer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_DINGDING_CHAT);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $chatSend = new ChatSend($msgData['app_id'], $msgData['ext_data']['agent_tag']);
        $chatSend->setChatId($msgData['receivers'][0]);
        $chatSend->setMsgData($msgData['template_params']['type'], $msgData['template_params']['data']);
        $sendRes = $chatSend->getDetail();
        $handleRes['code'] = $sendRes['code'];
        if ($sendRes['code'] > 0) {
            $handleRes['msg'] = $sendRes['data'];
        } else {
            $handleRes['data'] = $sendRes['message'];
        }

        return $handleRes;
    }
}
