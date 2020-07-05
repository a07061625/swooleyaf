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
use SySms\AliYun\SmsSendRequest;
use SyTool\Tool;

/**
 * Class AliYunSingle
 * @package SyMessageHandler\Consumers\Sms
 */
class AliYunSingle extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_SMS_ALIYUN_SINGLE);
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
        $smsSend = new SmsSendRequest();
        $smsSend->setTemplateCode($msgData['template_id']);
        $smsSend->setPhoneNumbers(implode(',', $msgData['receivers']));
        $smsSend->setSignName($msgData['template_sign']);
        if (!empty($msgData['template_params'])) {
            $smsSend->setTemplateParam(Tool::jsonEncode($msgData['template_params'], JSON_UNESCAPED_UNICODE));
        }
        $sendRes = $client->getAcsResponse($smsSend);
        if ($sendRes['Code'] == 'OK') {
            $handleRes['data'] = $sendRes;
        } else {
            $handleRes['code'] = ErrorCode::SMS_REQ_ALIYUN_ERROR;
            $handleRes['msg'] = $sendRes['Message'];
        }

        return $handleRes;
    }
}
