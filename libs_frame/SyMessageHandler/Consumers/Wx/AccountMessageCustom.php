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
use Wx\Account\Message\CustomMsgSend;

/**
 * Class AccountMessageCustom
 * @package SyMessageHandler\Consumers\Wx
 */
class AccountMessageCustom extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_MESSAGE_CUSTOM);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $messageCustom = new CustomMsgSend($msgData['app_id']);
        $messageCustom->setOpenid($msgData['receivers'][0]);
        $messageCustom->setMsgInfo($msgData['template_params']['type'], $msgData['template_params']['data']);
        if (strlen($msgData['ext_data']['access_token']) > 0) {
            $messageCustom->setAccessToken($msgData['ext_data']['access_token']);
        }
        $sendRes = $messageCustom->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
