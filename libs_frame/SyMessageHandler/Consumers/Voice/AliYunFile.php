<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */

namespace SyMessageHandler\Consumers\Voice;

use AlibabaCloud\Dyvmsapi\SingleCallByVoice;
use DesignPatterns\Singletons\VmsConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;

/**
 * Class AliYunFile
 *
 * @package SyMessageHandler\Consumers\Voice
 */
class AliYunFile extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_FILE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData): array
    {
        $handleRes = [
            'code' => 0,
        ];

        $callVoice = new SingleCallByVoice();
        $callVoice->client(VmsConfigSingleton::getInstance()->getAliYunKey())
            ->withCalledNumber($msgData['receivers'][0])
            ->withCalledShowNumber($msgData['ext_data']['show_number'])
            ->withVoiceCode($msgData['ext_data']['voice_id'])
            ->withPlayTimes($msgData['ext_data']['play_times'])
            ->withVolume($msgData['ext_data']['volume'])
            ->withSpeed($msgData['ext_data']['speed'])
            ->withOutId($msgData['ext_data']['out_id']);
        $sendRes = $callVoice->request()->toArray();
        if ('OK' == $sendRes['Code']) {
            $handleRes['data'] = $sendRes;
        } else {
            $handleRes['code'] = ErrorCode::VMS_REQ_ALIYUN_ERROR;
            $handleRes['msg'] = $sendRes['Message'];
        }

        return $handleRes;
    }
}
