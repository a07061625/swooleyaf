<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class CorpMessage
 * @package SyMessageHandler\Producers\Wx
 */
class CorpMessage extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE);
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
        $partyList = $msgData['party_list'] ?? [];
        if (!is_array($partyList)) {
            return '部门ID列表不合法';
        }
        $tagList = $msgData['tag_list'] ?? [];
        if (!is_array($tagList)) {
            return '标签ID列表不合法';
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
        $safe = $msgData['safe'] ?? 0;
        if (!is_int($safe)) {
            return '保密消息标识不合法';
        } elseif (!in_array($safe, [0, 1])) {
            return '保密消息标识不合法';
        }

        $this->msgData['app_id'] = $appId;
        $this->msgData['receivers'] = [
            'user_list' => $msgData['user_list'] ?? '@all',
            'party_list' => $partyList,
            'tag_list' => $tagList,
        ];
        $this->msgData['template_params']['type'] = $messageType;
        $this->msgData['template_params']['data'] = $messageData;
        $this->msgData['ext_data']['agent_tag'] = $agentTag;
        $this->msgData['ext_data']['safe'] = $safe;
        return '';
    }
}
