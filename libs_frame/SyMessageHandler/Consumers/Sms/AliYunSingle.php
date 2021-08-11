<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */

namespace SyMessageHandler\Consumers\Sms;

use AlibabaCloud\Dysmsapi\SendSms;
use DesignPatterns\Singletons\SmsConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use SyTool\Tool;

/**
 * Class AliYunSingle
 *
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

    public function handleMsgData(array $msgData): array
    {
        $handleRes = [
            'code' => 0,
        ];

        $smsSend = new SendSms();
        $smsSend->client(SmsConfigSingleton::getInstance()->getAliYunKey())
            ->withTemplateCode($msgData['template_id'])
            ->withPhoneNumbers(implode(',', $msgData['receivers']))
            ->withSignName($msgData['template_sign']);
        if (!empty($msgData['template_params'])) {
            $smsSend->withTemplateParam(Tool::jsonEncode($msgData['template_params'], JSON_UNESCAPED_UNICODE));
        }
        $sendRes = $smsSend->request()->toArray();
        if ('OK' == $sendRes['Code']) {
            $handleRes['data'] = $sendRes;
        } else {
            $handleRes['code'] = ErrorCode::SMS_REQ_ALIYUN_ERROR;
            $handleRes['msg'] = $sendRes['Message'];
        }

        return $handleRes;
    }
}
