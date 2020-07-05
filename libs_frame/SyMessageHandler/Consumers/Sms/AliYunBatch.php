<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Sms;

use AliOpen\Core\DefaultAcsClient;
use AliOpen\Core\Profile\DefaultProfile;
use DesignPatterns\Singletons\SmsConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use SySms\AliYun\SmsSendBatchRequest;
use SyTool\Tool;

/**
 * Class AliYunBatch
 * @package SyMessageHandler\Consumers\Sms
 */
class AliYunBatch extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_BATCH);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $config = SmsConfigSingleton::getInstance()->getAliYunConfig();
        $iClientProfile = DefaultProfile::getProfile($config->getRegionId(), $config->getAppKey(), $config->getAppSecret());
        $client = new DefaultAcsClient($iClientProfile);
        $smsBatch = new SmsSendBatchRequest();
        $smsBatch->setPhoneNumberJson(Tool::jsonEncode($msgData['receivers'], JSON_UNESCAPED_UNICODE));
        $smsBatch->setTemplateCode($msgData['template_id']);
        $smsBatch->setSignNameJson(Tool::jsonEncode($msgData['template_sign'], JSON_UNESCAPED_UNICODE));
        if (!empty($msgData['template_params'])) {
            $smsBatch->setTemplateParamJson(Tool::jsonEncode($msgData['template_params'], JSON_UNESCAPED_UNICODE));
        }
        $sendRes = $client->getAcsResponse($smsBatch);
        if ($sendRes['Code'] == 'OK') {
            $handleRes['data'] = $sendRes;
        } else {
            $handleRes['code'] = ErrorCode::SMS_REQ_ALIYUN_ERROR;
            $handleRes['msg'] = $sendRes['Message'];
        }

        return $handleRes;
    }
}
