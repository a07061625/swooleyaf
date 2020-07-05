<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/5 0005
 * Time: 15:19
 */
namespace SyMessageHandler\Producers;

/**
 * Class BaseDingDing
 * @package SyMessageHandler\Producers
 */
abstract class BaseDingDing extends Base
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
    }

    protected function checkAgentTag(array $data) : string
    {
        $agentTag = $data['agent_tag'] ?? '';
        if (!is_string($agentTag)) {
            return '应用标识不合法';
        } elseif (strlen($agentTag) == 0) {
            return '应用标识不能为空';
        }

        $this->msgData['ext_data']['agent_tag'] = $agentTag;
        return '';
    }

    protected function checkMessageType(array $data) : string
    {
        $messageType = $data['message_type'] ?? '';
        if (!is_string($messageType)) {
            return '消息类型不合法';
        } elseif (strlen($messageType) == 0) {
            return '消息类型不能为空';
        }

        $this->msgData['template_params']['type'] = $messageType;
        return '';
    }

    protected function checkMessageData(array $data) : string
    {
        $messageData = $data['message_data'] ?? [];
        if (!is_array($messageData)) {
            return '消息数据不合法';
        } elseif (empty($messageData)) {
            return '消息数据不能为空';
        }

        $this->msgData['template_params']['data'] = $messageData;
        return '';
    }
}
