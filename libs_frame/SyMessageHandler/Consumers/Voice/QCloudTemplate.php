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
use SyVms\QCloud\TemplateVoiceSend;
use SyVms\UtilQCloud;

/**
 * Class QCloudTemplate
 *
 * @package SyMessageHandler\Consumers\Voice
 */
class QCloudTemplate extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_VOICE_QCLOUD_TEMPLATE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $templateSend = new TemplateVoiceSend();
        $templateSend->setTplId($msgData['template_id']);
        $templateSend->setTplParams($msgData['template_params']);
        $templateSend->setTelMobile($msgData['receivers'][0]);
        $templateSend->setExt($msgData['ext_data']['ext']);
        $templateSend->setPlayTimes($msgData['ext_data']['play_times']);
        if (strlen($msgData['ext_data']['nation_code']) > 0) {
            $templateSend->setTelNationCode($msgData['ext_data']['nation_code']);
        }
        $handleRes = UtilQCloud::sendServiceRequest($templateSend);

        return $handleRes;
    }
}
