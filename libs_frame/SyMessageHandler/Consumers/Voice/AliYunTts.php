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
use SyTool\Tool;
use SyVms\AliYun\CallByTtsSingleRequest;

/**
 * Class AliYunTts
 *
 * @package SyMessageHandler\Consumers\Voice
 */
class AliYunTts extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_ALIYUN_TTS);
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
        $callTts = new CallByTtsSingleRequest();
        $callTts->setCalledNumber($msgData['receivers'][0]);
        $callTts->setTtsCode($msgData['template_id']);
        $callTts->setTtsParam(Tool::jsonEncode($msgData['template_params'], JSON_UNESCAPED_UNICODE));
        $callTts->setCalledShowNumber($msgData['ext_data']['show_number']);
        $callTts->setPlayTimes($msgData['ext_data']['play_times']);
        $callTts->setVolume($msgData['ext_data']['volume']);
        $callTts->setSpeed($msgData['ext_data']['speed']);
        $callTts->setOutId($msgData['ext_data']['out_id']);
        $sendRes = $client->getAcsResponse($callTts);
        if ($sendRes['Code'] == 'OK') {
            $handleRes['data'] = $sendRes;
        } else {
            $handleRes['code'] = ErrorCode::VMS_REQ_ALIYUN_ERROR;
            $handleRes['msg'] = $sendRes['Message'];
        }

        return $handleRes;
    }
}
