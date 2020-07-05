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
use Wx\Corp\Message\LinkedCorpMessageSend;

/**
 * Class CorpMessageLinked
 * @package SyMessageHandler\Consumers\Wx
 */
class CorpMessageLinked extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE_LINKED);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $messageLinked = new LinkedCorpMessageSend($msgData['app_id'], $msgData['ext_data']['agent_tag']);
        $messageLinked->setUserList($msgData['receivers']['user_list']);
        $messageLinked->setPartyList($msgData['receivers']['party_list']);
        $messageLinked->setTagList($msgData['receivers']['tag_list']);
        $messageLinked->setSendAllFlag($msgData['receivers']['send_all']);
        $messageLinked->setSafe($msgData['ext_data']['safe']);
        $messageLinked->setMsgData($msgData['template_params']['type'], $msgData['template_params']['data']);
        $sendRes = $messageLinked->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
