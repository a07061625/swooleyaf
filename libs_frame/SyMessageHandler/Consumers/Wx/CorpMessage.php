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
use Wx\Corp\Message\MessageSend;

/**
 * Class CorpMessage
 * @package SyMessageHandler\Consumers\Wx
 */
class CorpMessage extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $messageSend = new MessageSend($msgData['app_id'], $msgData['ext_data']['agent_tag']);
        $messageSend->setUserList($msgData['receivers']['user_list']);
        $messageSend->setPartyList($msgData['receivers']['party_list']);
        $messageSend->setTagList($msgData['receivers']['tag_list']);
        $messageSend->setMsgData($msgData['template_params']['type'], $msgData['template_params']['data']);
        $messageSend->setSafe($msgData['ext_data']['safe']);
        $sendRes = $messageSend->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
