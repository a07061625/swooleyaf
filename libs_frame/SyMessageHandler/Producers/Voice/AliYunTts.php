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
use SyMessageHandler\Producers\BaseVoiceAliYun;

/**
 * Class AliYunTts
 *
 * @package SyMessageHandler\Producers\Voice
 */
class AliYunTts extends BaseVoiceAliYun implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_TTS);
        $this->msgData['app_id'] = VmsConfigSingleton::getInstance()->getAliYunConfig()->getAccessKey();
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkCalledNumber',
            3 => 'checkShowNumber',
            4 => 'checkTemplateId',
            5 => 'checkTemplateParams',
            6 => 'checkPlayTimes',
            7 => 'checkVolume',
            8 => 'checkSpeed',
            9 => 'checkOutId',
        ];
    }

    private function __clone()
    {
    }
}
