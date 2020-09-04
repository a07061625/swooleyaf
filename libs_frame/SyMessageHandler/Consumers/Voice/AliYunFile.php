<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Voice;

use AliOpen\Core\DefaultAcsClient;
use AliOpen\Core\Profile\DefaultProfile;
use DesignPatterns\Singletons\VmsConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use SyVms\AliYun\CallByVoiceSingleRequest;

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

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $config = VmsConfigSingleton::getInstance()->getAliYunConfig();
        $iClientProfile = DefaultProfile::getProfile($config->getRegionId(), $config->getAccessKey(), $config->getAccessSecret());
        $client = new DefaultAcsClient($iClientProfile);
        $callVoice = new CallByVoiceSingleRequest();
        $callVoice->setCalledNumber($msgData['receivers'][0]);
        $callVoice->setCalledShowNumber($msgData['ext_data']['show_number']);
        $callVoice->setVoiceCode($msgData['ext_data']['voice_id']);
        $callVoice->setPlayTimes($msgData['ext_data']['play_times']);
        $callVoice->setVolume($msgData['ext_data']['volume']);
        $callVoice->setSpeed($msgData['ext_data']['speed']);
        $callVoice->setOutId($msgData['ext_data']['out_id']);
        $sendRes = $client->getAcsResponse($callVoice);
        if ($sendRes['Code'] == 'OK') {
            $handleRes['data'] = $sendRes;
        } else {
            $handleRes['code'] = ErrorCode::VMS_REQ_ALIYUN_ERROR;
            $handleRes['msg'] = $sendRes['Message'];
        }

        return $handleRes;
    }
}
