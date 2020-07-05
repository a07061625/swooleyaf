<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Voice;

use DesignPatterns\Singletons\VmsConfigSingleton;
use SyConstant\ProjectBase;
use SyMessageHandler\IProducer;
use SyMessageHandler\Producers\BaseVoiceQCloud;

/**
 * Class QCloudCode
 * @package SyMessageHandler\Producers\Voice
 */
class QCloudCode extends BaseVoiceQCloud implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE);
        $this->msgData['app_id'] = VmsConfigSingleton::getInstance()->getQCloudConfig()->getAppId();
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkMobile',
            3 => 'checkSmsCode',
            4 => 'checkExt',
            5 => 'checkPlayTimes',
            6 => 'checkNationCode',
        ];
    }

    private function __clone()
    {
    }

    private function checkSmsCode(array $data) : string
    {
        $smsCode = $data['sms_code'] ?? '';
        if (!is_string($smsCode)) {
            return '验证码不合法';
        } elseif (!ctype_digit($smsCode)) {
            return '验证码不合法';
        }

        $this->msgData['template_params']['code'] = $smsCode;
        return '';
    }
}
