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
 * Class QCloudTemplate
 * @package SyMessageHandler\Producers\Voice
 */
class QCloudTemplate extends BaseVoiceQCloud implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_TEMPLATE);
        $this->msgData['app_id'] = VmsConfigSingleton::getInstance()->getQCloudConfig()->getAppId();
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkMobile',
            3 => 'checkTemplateId',
            4 => 'checkTemplateParams',
            5 => 'checkExt',
            6 => 'checkPlayTimes',
            7 => 'checkNationCode',
        ];
    }

    private function __clone()
    {
    }
}
