<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Sms;

use DesignPatterns\Singletons\SmsConfigSingleton;
use SyConstant\ProjectBase;
use SyMessageHandler\IProducer;
use SyMessageHandler\Producers\BaseSms;

/**
 * Class Yun253
 * @package SyMessageHandler\Producers\Sms
 */
class Yun253 extends BaseSms implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_SMS_YUN253);
        $this->msgData['app_id'] = SmsConfigSingleton::getInstance()->getYun253Config()->getAppKey();
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkReceivers',
            3 => 'checkTemplateSign',
            4 => 'checkTemplateMsg',
        ];
    }

    private function __clone()
    {
    }

    private function checkTemplateSign(array $data) : string
    {
        $templateSign = $data['template_sign'] ?? '';
        if (!is_string($templateSign)) {
            return '模板签名不合法';
        } elseif (strlen($templateSign) == 0) {
            return '模板签名不能为空';
        }

        $this->msgData['template_sign'] = $templateSign;
        return '';
    }

    private function checkTemplateMsg(array $data) : string
    {
        $templateMsg = $data['template_msg'] ?? '';
        if (!is_string($templateMsg)) {
            return '模板消息不合法';
        } elseif (strlen($templateMsg) == 0) {
            return '模板消息不能为空';
        }

        $this->msgData['template_params']['msg'] = $templateMsg;
        return '';
    }
}
