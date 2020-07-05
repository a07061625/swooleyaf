<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use Wx\Account\Message\MassSendAll;

/**
 * Class AccountMassAll
 * @package SyMessageHandler\Consumers\Wx
 */
class AccountMassAll extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MASS_ALL);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $massSendAll = new MassSendAll($msgData['app_id']);
        $massSendAll->setFilter($msgData['receivers']['filter']);
        $massSendAll->setMsgData($msgData['template_params']['type'], $msgData['template_params']['data']);
        $massSendAll->setClientMsgId($msgData['ext_data']['msg_id']);
        $sendRes = $massSendAll->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
