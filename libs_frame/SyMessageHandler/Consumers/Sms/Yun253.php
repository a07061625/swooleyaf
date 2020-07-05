<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Sms;

use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use SySms\SmsUtilYun253;
use SySms\Yun253\SmsSend;

/**
 * Class Yun253
 * @package SyMessageHandler\Consumers\Sms
 */
class Yun253 extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_SMS_YUN253);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $smsSend = new SmsSend();
        $smsSend->setPhoneList($msgData['receivers']);
        $smsSend->setSignNameAndMsg($msgData['template_sign'], $msgData['template_params']['msg']);
        $handleRes = SmsUtilYun253::sendServiceRequest($smsSend);

        return $handleRes;
    }
}
