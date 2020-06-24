<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Sms;

use DesignPatterns\Singletons\SmsConfigSingleton;
use SyConstant\Project;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class DaYu
 * @package SyMessageHandler\Producers\Sms
 */
class DaYu extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_SMS_DAYU);
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
        $templateId = $msgData['template_id'] ?? '';
        if (!is_string($templateId)) {
            return '模板ID不合法';
        } elseif (strlen($templateId) == 0) {
            return '模板ID不能为空';
        }
        $templateSign = $msgData['template_sign'] ?? '';
        if (!is_string($templateSign)) {
            return '模板签名不合法';
        } elseif (strlen($templateSign) == 0) {
            return '模板签名不能为空';
        }
        $templateParams = $msgData['template_params'] ?? [];
        if (!is_array($templateParams)) {
            return '短信模板参数不合法';
        }

        $this->msgData['app_id'] = SmsConfigSingleton::getInstance()->getDaYuConfig()->getAppKey();
        $this->msgData['receivers'] = $receivers;
        $this->msgData['template_id'] = $templateId;
        $this->msgData['template_sign'] = $templateSign;
        $this->msgData['template_params'] = $templateParams;
        return '';
    }
}
