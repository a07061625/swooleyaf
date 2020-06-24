<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Voice;

use SyConstant\Project;
use SyMessageHandler\ConsumerBase;
use SyMessageHandler\IConsumer;
use SyVms\QCloud\CodeVoiceSend;
use SyVms\VmsUtilQCloud;

/**
 * Class QCloudCode
 * @package SyMessageHandler\Consumers\Voice
 */
class QCloudCode extends ConsumerBase implements IConsumer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $codeSend = new CodeVoiceSend();
        $codeSend->setTelMobile($msgData['receivers'][0]);
        $codeSend->setExt($msgData['ext_data']['ext']);
        $codeSend->setMsg($msgData['template_params']['code']);
        $codeSend->setPlayTimes($msgData['ext_data']['play_times']);
        if (strlen($msgData['ext_data']['nation_code']) > 0) {
            $codeSend->setTelNationCode($msgData['ext_data']['nation_code']);
        }
        $handleRes = VmsUtilQCloud::sendServiceRequest($codeSend);

        return $handleRes;
    }
}
