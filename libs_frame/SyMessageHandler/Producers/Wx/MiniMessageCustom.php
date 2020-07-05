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
 * Class MiniMessageCustom
 * @package SyMessageHandler\Producers\Wx
 */
class MiniMessageCustom extends BaseWx implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_MINI_MESSAGE_CUSTOM);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkOpenid',
            4 => 'checkMessageType',
            5 => 'checkMessageData',
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
}
