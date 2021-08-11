<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */

namespace SyMessageHandler\Consumers\Sms;

use AlibabaCloud\Dysmsapi\SendBatchSms;
use DesignPatterns\Singletons\SmsConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use SyTool\Tool;

/**
 * Class AliYunBatch
 *
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

    public function handleMsgData(array $msgData): array
    {
        $handleRes = [
            'code' => 0,
        ];

        $smsBatch = new SendBatchSms();
        $smsBatch->client(SmsConfigSingleton::getInstance()->getAliYunKey())
            ->withPhoneNumberJson(Tool::jsonEncode($msgData['receivers'], JSON_UNESCAPED_UNICODE))
            ->withTemplateCode($msgData['template_id'])
            ->withSignNameJson(Tool::jsonEncode($msgData['template_sign'], JSON_UNESCAPED_UNICODE));
        if (!empty($msgData['template_params'])) {
            $smsBatch->withTemplateParamJson(Tool::jsonEncode($msgData['template_params'], JSON_UNESCAPED_UNICODE));
        }
        $sendRes = $smsBatch->request()->toArray();
        if ('OK' == $sendRes['Code']) {
            $handleRes['data'] = $sendRes;
        } else {
            $handleRes['code'] = ErrorCode::SMS_REQ_ALIYUN_ERROR;
            $handleRes['msg'] = $sendRes['Message'];
        }

        return $handleRes;
    }
}
