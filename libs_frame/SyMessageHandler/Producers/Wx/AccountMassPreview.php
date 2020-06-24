<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\Project;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class AccountMassPreview
 * @package SyMessageHandler\Producers\Wx
 */
class AccountMassPreview extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW);
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
        $openid = $msgData['openid'] ?? '';
        if (!is_string($openid)) {
            return '用户openid不合法';
        }
        $wxName = $msgData['wx_name'] ?? '';
        if (!is_string($wxName)) {
            return '公众号名称不合法';
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
            'openid' => $openid,
            'wx_name' => $wxName,
        ];
        $this->msgData['template_params']['type'] = $messageType;
        $this->msgData['template_params']['data'] = $messageData;
        return '';
    }
}
