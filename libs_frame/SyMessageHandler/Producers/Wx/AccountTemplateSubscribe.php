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
 * Class AccountTemplateSubscribe
 * @package SyMessageHandler\Producers\Wx
 */
class AccountTemplateSubscribe extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE_SUBSCRIBE);
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
        } elseif (strlen($openid) == 0) {
            return '用户openid不能为空';
        }
        $templateId = $msgData['template_id'] ?? '';
        if (!is_string($templateId)) {
            return '模板ID不合法';
        } elseif (strlen($templateId) == 0) {
            return '模板ID不能为空';
        }
        $templateParams = $msgData['template_params'] ?? [];
        if (!is_array($templateParams)) {
            return '模板参数不合法';
        } elseif (empty($templateParams)) {
            return '模板参数不能为空';
        }
        $redirectUrl = $msgData['redirect_url'] ?? '';
        if (!is_string($redirectUrl)) {
            return '重定向地址不合法';
        }
        $miniParams = $msgData['mini_params'] ?? [];
        if (!is_array($miniParams)) {
            return '小程序跳转数据不合法';
        }
        $scene = $msgData['scene'] ?? 0;
        if (!is_int($scene)) {
            return '订阅场景值不合法';
        } elseif ($scene < 0) {
            return '订阅场景值不合法';
        }
        $title = $msgData['title'] ?? '';
        if (!is_string($title)) {
            return '消息标题不合法';
        } elseif (mb_strlen($title) == 0) {
            return '消息标题不能为空';
        } elseif (mb_strlen($title) > 15) {
            return '消息标题不合法';
        }

        $this->msgData['app_id'] = $appId;
        $this->msgData['receivers'] = [
            0 => $openid,
        ];
        $this->msgData['template_id'] = $templateId;
        $this->msgData['template_params'] = $templateParams;
        $this->msgData['ext_data']['redirect_url'] = $redirectUrl;
        $this->msgData['ext_data']['mini_params'] = $miniParams;
        $this->msgData['ext_data']['scene'] = $scene;
        $this->msgData['ext_data']['title'] = $title;
        return '';
    }
}
