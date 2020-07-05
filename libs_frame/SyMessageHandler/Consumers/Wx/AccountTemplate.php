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
use Wx\Account\Message\TemplateMsgSend;

/**
 * Class AccountTemplate
 * @package SyMessageHandler\Consumers\Wx
 */
class AccountTemplate extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_ACCOUNT_TEMPLATE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $templateMsg = new TemplateMsgSend($msgData['app_id']);
        $templateMsg->setOpenid($msgData['receivers'][0]);
        $templateMsg->setTemplateId($msgData['template_id']);
        $templateMsg->setTemplateData($msgData['template_params']);
        if (strlen($msgData['ext_data']['redirect_url']) > 0) {
            $templateMsg->setRedirectUrl($msgData['ext_data']['redirect_url']);
        }
        if (!empty($msgData['ext_data']['mini_params'])) {
            $templateMsg->setMiniProgram($msgData['ext_data']['mini_params']);
        }
        $sendRes = $templateMsg->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
