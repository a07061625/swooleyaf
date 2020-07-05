<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/5 0005
 * Time: 15:19
 */
namespace SyMessageHandler\Producers;

/**
 * Class BaseVoiceQCloud
 * @package SyMessageHandler\Producers
 */
abstract class BaseVoiceQCloud extends Base
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
    }

    protected function checkMobile(array $data) : string
    {
        $mobile = $data['mobile'] ?? '';
        if (!is_string($mobile)) {
            return '电话号码不合法';
        } elseif (!ctype_digit($mobile)) {
            return '电话号码不合法';
        }

        $this->msgData['receivers'] = [
            0 => $mobile,
        ];
        return '';
    }

    protected function checkExt(array $data) : string
    {
        $ext = $data['ext'] ?? '';
        if (!is_string($ext)) {
            return '扩展信息不合法';
        }

        $this->msgData['ext_data']['ext'] = $ext;
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

    protected function checkNationCode(array $data) : string
    {
        $nationCode = $data['nation_code'] ?? '';
        if (!is_string($nationCode)) {
            return '国家码不合法';
        } elseif ((strlen($nationCode) > 0) && !ctype_digit($nationCode)) {
            return '国家码不合法';
        }

        $this->msgData['ext_data']['nation_code'] = $nationCode;
        return '';
    }
}
