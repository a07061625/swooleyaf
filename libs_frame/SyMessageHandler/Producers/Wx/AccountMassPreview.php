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
 * Class AccountMassPreview
 * @package SyMessageHandler\Producers\Wx
 */
class AccountMassPreview extends BaseWx implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_PREVIEW);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkOpenid',
            4 => 'checkWxName',
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
        }

        $this->msgData['receivers']['openid'] = $openid;
        return '';
    }

    private function checkWxName(array $data) : string
    {
        $wxName = $data['wx_name'] ?? '';
        if (!is_string($wxName)) {
            return '公众号名称不合法';
        }

        $this->msgData['receivers']['wx_name'] = $wxName;
        return '';
    }
}
