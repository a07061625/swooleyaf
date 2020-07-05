<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\DingDing;

use DingDing\Corp\Message\CorpAsyncSend;
use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;

/**
 * Class ConversationAsync
 * @package SyMessageHandler\Consumers\DingDing
 */
class ConversationAsync extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION_ASYNC);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $corpAsyncSend = new CorpAsyncSend($msgData['app_id'], $msgData['ext_data']['agent_tag']);
        $corpAsyncSend->setUserList($msgData['receivers']['user_ids']);
        $corpAsyncSend->setDepartmentList($msgData['receivers']['dept_ids']);
        $corpAsyncSend->setToAllUser($msgData['receivers']['all_user']);
        $corpAsyncSend->setMsgData($msgData['template_params']['type'], $msgData['template_params']['data']);
        $sendRes = $corpAsyncSend->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
