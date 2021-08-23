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
 * Class AliYunBatch
 *
 * @package SyMessageHandler\Producers\Sms
 */
class AliYunBatch extends BaseSms implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_BATCH);
        $this->msgData['app_id'] = SmsConfigSingleton::getInstance()->getAliYunKey();
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkReceivers',
            3 => 'checkTemplateId',
            4 => 'checkTemplateSign',
            5 => 'checkTemplateParams',
        ];
    }

    private function __clone()
    {
    }

    private function checkTemplateSign(array $data): string
    {
        $templateSign = $data['template_sign'] ?? [];
        if (!\is_array($templateSign)) {
            return '模板签名不合法';
        }
        if (empty($templateSign)) {
            return '模板签名不能为空';
        }

        $this->msgData['template_sign'] = $templateSign;

        return '';
    }
}
