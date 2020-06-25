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

/**
 * Class QCloudTemplate
 * @package SyMessageHandler\Producers\Voice
 */
class QCloudTemplate extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_TEMPLATE);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData) : string
    {
        $mobile = $msgData['mobile'] ?? '';
        if (!is_string($mobile)) {
            return '电话号码不合法';
        } elseif (!ctype_digit($mobile)) {
            return '电话号码不合法';
        }
        $tplId = $msgData['tpl_id'] ?? '';
        if (!is_string($tplId)) {
            return '模板ID不合法';
        } elseif (strlen($tplId) == 0) {
            return '模板ID不合法';
        }
        $tplParams = $msgData['tpl_params'] ?? [];
        if (!is_array($tplParams)) {
            return '模板参数不合法';
        }
        $ext = $msgData['ext'] ?? '';
        if (!is_string($ext)) {
            return '扩展信息不合法';
        }
        $playTimes = $msgData['play_times'] ?? 1;
        if (!is_int($playTimes)) {
            return '播放次数不合法';
        } elseif (($playTimes < 1) || ($playTimes > 3)) {
            return '播放次数不合法';
        }
        $nationCode = $msgData['nation_code'] ?? '';
        if (!is_string($nationCode)) {
            return '国家码不合法';
        } elseif ((strlen($nationCode) > 0) && !ctype_digit($nationCode)) {
            return '国家码不合法';
        }

        $this->msgData['app_id'] = VmsConfigSingleton::getInstance()->getQCloudConfig()->getAppId();
        $this->msgData['receivers'] = [
            0 => $mobile,
        ];
        $this->msgData['template_id'] = $tplId;
        $this->msgData['template_params'] = $tplParams;
        $this->msgData['ext_data']['ext'] = $ext;
        $this->msgData['ext_data']['play_times'] = $playTimes;
        $this->msgData['ext_data']['nation_code'] = $nationCode;
        return '';
    }
}
