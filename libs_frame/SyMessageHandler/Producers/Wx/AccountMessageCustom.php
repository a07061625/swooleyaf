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
 * Class AccountMessageCustom
 * @package SyMessageHandler\Producers\Wx
 */
class AccountMessageCustom extends BaseWx implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MESSAGE_CUSTOM);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkOpenid',
            4 => 'checkAccessToken',
            5 => 'checkMessageType',
            6 => 'checkMessageData',
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

    private function checkAccessToken(array $data) : string
    {
        $accessToken = $data['access_token'] ?? '';
        if (!is_string($accessToken)) {
            return '令牌不合法';
        }

        $this->msgData['ext_data']['access_token'] = $accessToken;
        return '';
    }
}
