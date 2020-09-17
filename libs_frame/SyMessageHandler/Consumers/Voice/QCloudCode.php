<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Voice;

use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use SyVms\QCloud\CodeVoiceSend;
use SyVms\UtilQCloud;

/**
 * Class QCloudCode
 *
 * @package SyMessageHandler\Consumers\Voice
 */
class QCloudCode extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_CODE);
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
        $handleRes = UtilQCloud::sendServiceRequest($codeSend);

        return $handleRes;
    }
}
