<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\IProducer;
use SyMessageHandler\Producers\BaseWx;

/**
 * Class AccountTemplate
 * @package SyMessageHandler\Producers\Wx
 */
class AccountTemplate extends BaseWx implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkOpenid',
            4 => 'checkTemplateId',
            5 => 'checkTemplateParams',
            6 => 'checkRedirectUrl',
            7 => 'checkMiniParams',
        ];
    }

    private function __clone()
    {
    }

    private function checkOpenid(array $data) : string
    {
        $openid = $data['openid'] ?? '';
        if (!is_string($openid)) {
            return '用户openid不合法';
        } elseif (strlen($openid) == 0) {
            return '用户openid不能为空';
        }

        $this->msgData['receivers'] = [
            0 => $openid,
        ];
        return '';
    }

    private function checkRedirectUrl(array $data) : string
    {
        $redirectUrl = $data['redirect_url'] ?? '';
        if (!is_string($redirectUrl)) {
            return '重定向地址不合法';
        }

        $this->msgData['ext_data']['redirect_url'] = $redirectUrl;
        return '';
    }

    private function checkMiniParams(array $data) : string
    {
        $miniParams = $data['mini_params'] ?? [];
        if (!is_array($miniParams)) {
            return '小程序跳转数据不合法';
        }

        $this->msgData['ext_data']['mini_params'] = $miniParams;
        return '';
    }
}
