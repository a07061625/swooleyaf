<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:09
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\IProducer;
use SyMessageHandler\Producers\BaseWx;

/**
 * Class AccountMass
 * @package SyMessageHandler\Producers\Wx
 */
class AccountMass extends BaseWx implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkOpenidList',
            4 => 'checkMessageType',
            5 => 'checkMessageData',
        ];
    }

    private function __clone()
    {
    }

    private function checkOpenidList(array $data) : string
    {
        $openidList = $data['openid_list'] ?? [];
        if (!is_array($openidList)) {
            return '用户openid列表不合法';
        } elseif (empty($openidList)) {
            return '用户openid列表不能为空';
        }

        $this->msgData['receivers'] = [
            'openid_list' => $openidList,
        ];
        return '';
    }
}
