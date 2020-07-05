<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use Wx\Corp\Message\AppChatSend;

/**
 * Class CorpChat
 * @package SyMessageHandler\Consumers\Wx
 */
class CorpChat extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_CHAT);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $chatSend = new AppChatSend($msgData['app_id'], $msgData['ext_data']['agent_tag']);
        $chatSend->setChatId($msgData['receivers'][0]);
        $chatSend->setMsgData($msgData['template_params']['type'], $msgData['template_params']['data']);
        $chatSend->setSafe($msgData['ext_data']['safe']);
        $sendRes = $chatSend->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
