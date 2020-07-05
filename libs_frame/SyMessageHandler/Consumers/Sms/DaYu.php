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
use SySms\DaYu\SmsSend;
use SySms\SmsUtilDaYu;

/**
 * Class DaYu
 * @package SyMessageHandler\Consumers\Sms
 */
class DaYu extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_SMS_DAYU);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $smsSend = new SmsSend();
        $smsSend->setRecNumList($msgData['receivers']);
        $smsSend->setSignName($msgData['template_sign']);
        $smsSend->setTemplateId($msgData['template_id']);
        $smsSend->setSmsParams($msgData['template_params']);
        $handleRes = SmsUtilDaYu::sendServiceRequest($smsSend);

        return $handleRes;
    }
}
