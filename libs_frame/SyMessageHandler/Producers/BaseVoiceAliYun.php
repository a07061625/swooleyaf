<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/5 0005
 * Time: 17:19
 */
namespace SyMessageHandler\Producers;

use SyTool\Tool;

/**
 * Class BaseVoiceAliYun
 * @package SyMessageHandler\Producers
 */
abstract class BaseVoiceAliYun extends Base
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
    }

    protected function checkCalledNumber(array $data) : string
    {
        $calledNumber = $data['called_number'] ?? '';
        if (!is_string($calledNumber)) {
            return '被叫号码不合法';
        } elseif (!ctype_digit($calledNumber)) {
            return '被叫号码不合法';
        }

        $this->msgData['receivers'] = [
            0 => $calledNumber,
        ];
        return '';
    }

    protected function checkShowNumber(array $data) : string
    {
        $showNumber = $data['show_number'] ?? '';
        if (!is_string($showNumber)) {
            return '被叫显号不合法';
        } elseif (strlen($showNumber) == 0) {
            return '被叫显号不能为空';
        }

        $this->msgData['ext_data']['show_number'] = $showNumber;
        return '';
    }

    protected function checkPlayTimes(array $data) : string
    {
        $playTimes = $data['play_times'] ?? 1;
        if (!is_int($playTimes)) {
            return '播放次数不合法';
        } elseif (($playTimes < 1) || ($playTimes > 3)) {
            return '播放次数不合法';
        }

        $this->msgData['ext_data']['play_times'] = $playTimes;
        return '';
    }

    protected function checkVolume(array $data) : string
    {
        $volume = $data['volume'] ?? 100;
        if (!is_int($volume)) {
            return '音量不合法';
        } elseif (($volume < 0) || ($volume > 100)) {
            return '音量不合法';
        }

        $this->msgData['ext_data']['volume'] = $volume;
        return '';
    }

    protected function checkSpeed(array $data) : string
    {
        $speed = $data['speed'] ?? 0;
        if (!is_int($speed)) {
            return '语速不合法';
        } elseif (($speed < -500) || ($speed > 500)) {
            return '语速不合法';
        }

        $this->msgData['ext_data']['speed'] = $speed;
        return '';
    }

    protected function checkOutId(array $data) : string
    {
        $outId = $data['out_id'] ?? Tool::createNonceStr(4, 'numlower') . Tool::getNowTime();
        if (!is_string($outId)) {
            return '回执ID不合法';
        } elseif (!ctype_alnum($outId)) {
            return '回执ID不合法';
        } elseif (strlen($outId) > 15) {
            return '回执ID不合法';
        }

        $this->msgData['ext_data']['out_id'] = $outId;
        return '';
    }
}
