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
 * Class AliYunFile
 *
 * @package SyMessageHandler\Producers\Voice
 */
class AliYunFile extends BaseVoiceAliYun implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE);
        $this->msgData['app_id'] = VmsConfigSingleton::getInstance()->getAliYunConfig()->getAccessKey();
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkCalledNumber',
            3 => 'checkShowNumber',
            4 => 'checkVoiceId',
            5 => 'checkPlayTimes',
            6 => 'checkVolume',
            7 => 'checkSpeed',
            8 => 'checkOutId',
        ];
    }

    private function __clone()
    {
    }

    private function checkVoiceId(array $data) : string
    {
        $voiceId = $data['voice_id'] ?? '';
        if (!is_string($voiceId)) {
            return '语音ID不合法';
        } elseif (strlen($voiceId) == 0) {
            return '语音ID不能为空';
        }

        $this->msgData['ext_data']['voice_id'] = $voiceId;

        return '';
    }
}
