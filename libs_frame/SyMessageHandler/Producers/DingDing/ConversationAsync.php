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
 * Class ConversationAsync
 * @package SyMessageHandler\Producers\DingDing
 */
class ConversationAsync extends BaseDingDing implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION_ASYNC);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkAgentTag',
            4 => 'checkUserIdList',
            5 => 'checkDeptIdList',
            6 => 'checkAllUser',
            7 => 'checkMessageType',
            8 => 'checkMessageData',
        ];
    }

    private function __clone()
    {
    }

    private function checkUserIdList(array $data) : string
    {
        $userIds = $data['user_ids'] ?? [];
        if (!is_array($userIds)) {
            return '用户列表不合法';
        }

        $this->msgData['receivers']['user_ids'] = $userIds;
        return '';
    }

    private function checkDeptIdList(array $data) : string
    {
        $deptIds = $msgData['dept_ids'] ?? [];
        if (!is_array($deptIds)) {
            return '部门列表不合法';
        }

        $this->msgData['receivers']['dept_ids'] = $deptIds;
        return '';
    }

    private function checkAllUser(array $data) : string
    {
        $allUser = $msgData['all_user'] ?? false;
        if (!is_bool($allUser)) {
            return '全部用户标识不合法';
        }

        $this->msgData['receivers']['all_user'] = $allUser;
        return '';
    }
}
