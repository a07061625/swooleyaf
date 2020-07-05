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
use Wx\Account\Message\SubscribeMsgSend;

/**
 * Class AccountTemplateSubscribe
 * @package SyMessageHandler\Consumers\Wx
 */
class AccountTemplateSubscribe extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE_SUBSCRIBE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $templateSubscribe = new SubscribeMsgSend($msgData['app_id']);
        $templateSubscribe->setOpenid($msgData['receivers'][0]);
        $templateSubscribe->setTemplateId($msgData['template_id']);
        $templateSubscribe->setData($msgData['template_params']);
        $templateSubscribe->setScene($msgData['ext_data']['scene']);
        $templateSubscribe->setTitle($msgData['ext_data']['title']);
        if (strlen($msgData['ext_data']['redirect_url']) > 0) {
            $templateSubscribe->setUrl($msgData['ext_data']['redirect_url']);
        }
        if (!empty($msgData['ext_data']['mini_params'])) {
            $templateSubscribe->setMiniProgram($msgData['ext_data']['mini_params']);
        }
        $sendRes = $templateSubscribe->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
