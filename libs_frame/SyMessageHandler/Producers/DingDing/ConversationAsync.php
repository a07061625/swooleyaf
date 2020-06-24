<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\DingDing;

use SyConstant\Project;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class ConversationAsync
 * @package SyMessageHandler\Producers\DingDing
 */
class ConversationAsync extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_DINGDING_CONVERSATION_ASYNC);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData) : string
    {
        $appId = $msgData['app_id'] ?? '';
        if (!is_string($appId)) {
            return '应用ID不合法';
        } elseif (strlen($appId) == 0) {
            return '应用ID不能为空';
        }
        $agentTag = $msgData['agent_tag'] ?? '';
        if (!is_string($agentTag)) {
            return '应用标识不合法';
        } elseif (strlen($agentTag) == 0) {
            return '应用标识不能为空';
        }
        $userIds = $msgData['user_ids'] ?? [];
        if (!is_array($userIds)) {
            return '用户列表不合法';
        }
        $deptIds = $msgData['dept_ids'] ?? [];
        if (!is_array($deptIds)) {
            return '部门列表不合法';
        }
        $allUser = $msgData['all_user'] ?? false;
        if (!is_bool($allUser)) {
            return '全部用户标识不合法';
        }
        $messageType = $msgData['message_type'] ?? '';
        if (!is_string($messageType)) {
            return '消息类型不合法';
        } elseif (strlen($messageType) == 0) {
            return '消息类型不能为空';
        }
        $messageData = $msgData['message_data'] ?? [];
        if (!is_array($messageData)) {
            return '消息数据不合法';
        } elseif (empty($messageData)) {
            return '消息数据不能为空';
        }

        $this->msgData['app_id'] = $appId;
        $this->msgData['receivers'] = [
            'user_ids' => $userIds,
            'dept_ids' => $deptIds,
            'all_user' => $allUser,
        ];
        $this->msgData['template_params']['type'] = $messageType;
        $this->msgData['template_params']['data'] = $messageData;
        $this->msgData['ext_data']['agent_tag'] = $agentTag;
        return '';
    }
}
