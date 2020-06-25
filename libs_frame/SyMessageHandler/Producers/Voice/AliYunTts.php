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
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;
use SyTool\Tool;

/**
 * Class AliYunTts
 * @package SyMessageHandler\Producers\Voice
 */
class AliYunTts extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_TTS);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData) : string
    {
        $calledNumber = $msgData['called_number'] ?? '';
        if (!is_string($calledNumber)) {
            return '被叫号码不合法';
        } elseif (!ctype_digit($calledNumber)) {
            return '被叫号码不合法';
        }
        $showNumber = $msgData['show_number'] ?? '';
        if (!is_string($showNumber)) {
            return '被叫显号不合法';
        } elseif (strlen($showNumber) == 0) {
            return '被叫显号不能为空';
        }
        $ttsCode = $msgData['tts_code'] ?? '';
        if (!is_string($ttsCode)) {
            return '语音验证码模板ID不合法';
        } elseif (strlen($ttsCode) == 0) {
            return '语音验证码模板ID不能为空';
        }
        $ttsParams = $msgData['tts_params'] ?? [];
        if (!is_array($ttsParams)) {
            return '语音验证码模板参数不合法';
        }
        $playTimes = $msgData['play_times'] ?? 1;
        if (!is_int($playTimes)) {
            return '播放次数不合法';
        } elseif (($playTimes < 1) || ($playTimes > 3)) {
            return '播放次数不合法';
        }
        $volume = $msgData['volume'] ?? 100;
        if (!is_int($volume)) {
            return '音量不合法';
        } elseif (($volume < 0) || ($volume > 100)) {
            return '音量不合法';
        }
        $speed = $msgData['speed'] ?? 0;
        if (!is_int($speed)) {
            return '语速不合法';
        } elseif (($speed < -500) || ($speed > 500)) {
            return '语速不合法';
        }
        $outId = $msgData['out_id'] ?? Tool::createNonceStr(4, 'numlower') . Tool::getNowTime();
        if (!is_string($outId)) {
            return '回执ID不合法';
        } elseif (!ctype_alnum($outId)) {
            return '回执ID不合法';
        } elseif (strlen($outId) > 15) {
            return '回执ID不合法';
        }

        $this->msgData['app_id'] = VmsConfigSingleton::getInstance()->getAliYunConfig()->getAppKey();
        $this->msgData['receivers'] = [
            0 => $calledNumber,
        ];
        $this->msgData['template_id'] = $ttsCode;
        $this->msgData['template_params'] = $ttsParams;
        $this->msgData['ext_data']['show_number'] = $showNumber;
        $this->msgData['ext_data']['play_times'] = $playTimes;
        $this->msgData['ext_data']['volume'] = $volume;
        $this->msgData['ext_data']['speed'] = $speed;
        $this->msgData['ext_data']['out_id'] = $outId;
        return '';
    }
}
