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
 * Class AccountMassAll
 * @package SyMessageHandler\Producers\Wx
 */
class AccountMassAll extends BaseWx implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_ALL);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkFilter',
            4 => 'checkMsgId',
            5 => 'checkMessageType',
            6 => 'checkMessageData',
        ];
    }

    private function __clone()
    {
    }

    private function checkFilter(array $data) : string
    {
        $filter = $data['filter'] ?? [];
        if (!is_array($filter)) {
            return '接收者数据不合法';
        } elseif (empty($filter)) {
            return '接收者数据不能为空';
        }

        $this->msgData['receivers'] = [
            'filter' => $filter,
        ];
        return '';
    }

    private function checkMsgId(array $data) : string
    {
        $msgId = $data['msg_id'] ?? '';
        if (!is_string($msgId)) {
            return '群发消息ID不合法';
        } elseif (!ctype_alnum($msgId)) {
            return '群发消息ID不合法';
        }

        $this->msgData['ext_data']['msg_id'] = $msgId;
        return '';
    }
}
