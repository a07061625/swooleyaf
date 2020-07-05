<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/5 0005
 * Time: 15:20
 */
namespace SyMessageHandler\Producers;

/**
 * Class BaseWx
 * @package SyMessageHandler\Producers
 */
abstract class BaseWx extends Base
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
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
