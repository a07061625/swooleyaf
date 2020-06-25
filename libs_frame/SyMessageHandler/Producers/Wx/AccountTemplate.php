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
 * Class AccountTemplate
 * @package SyMessageHandler\Producers\Wx
 */
class AccountTemplate extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE);
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
        }
        $redirectUrl = $msgData['redirect_url'] ?? '';
        if (!is_string($redirectUrl)) {
            return '重定向地址不合法';
        }
        $miniParams = $msgData['mini_params'] ?? [];
        if (!is_array($miniParams)) {
            return '小程序跳转数据不合法';
        }

        $this->msgData['app_id'] = $appId;
        $this->msgData['receivers'] = [
            0 => $openid,
        ];
        $this->msgData['template_id'] = $templateId;
        $this->msgData['template_params'] = $templateParams;
        $this->msgData['ext_data']['redirect_url'] = $redirectUrl;
        $this->msgData['ext_data']['mini_params'] = $miniParams;
        return '';
    }
}
