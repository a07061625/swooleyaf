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
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class Yun253
 * @package SyMessageHandler\Producers\Sms
 */
class Yun253 extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_SMS_YUN253);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData) : string
    {
        $receivers = $msgData['receivers'] ?? [];
        if (!is_array($receivers)) {
            return '接收人不合法';
        } elseif (empty($receivers)) {
            return '接收人不能为空';
        }
        $templateSign = $msgData['template_sign'] ?? '';
        if (!is_string($templateSign)) {
            return '模板签名不合法';
        } elseif (strlen($templateSign) == 0) {
            return '模板签名不能为空';
        }
        $templateMsg = $msgData['template_msg'] ?? '';
        if (!is_string($templateMsg)) {
            return '模板消息不合法';
        } elseif (strlen($templateMsg) == 0) {
            return '模板消息不能为空';
        }

        $this->msgData['app_id'] = SmsConfigSingleton::getInstance()->getYun253Config()->getAppKey();
        $this->msgData['receivers'] = $receivers;
        $this->msgData['template_sign'] = $templateSign;
        $this->msgData['template_params']['msg'] = $templateMsg;
        return '';
    }
}
