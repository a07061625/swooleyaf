<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */

namespace SyMessageHandler\Consumers\Voice;

use AlibabaCloud\Dyvmsapi\SingleCallByTts;
use DesignPatterns\Singletons\VmsConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use SyTool\Tool;

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

    public function handleMsgData(array $msgData): array
    {
        $handleRes = [
            'code' => 0,
        ];

        $callTts = new SingleCallByTts();
        $callTts->client(VmsConfigSingleton::getInstance()->getAliYunKey())
            ->withCalledNumber($msgData['receivers'][0])
            ->withTtsCode($msgData['template_id'])
            ->withTtsParam(Tool::jsonEncode($msgData['template_params'], JSON_UNESCAPED_UNICODE))
            ->withCalledShowNumber($msgData['ext_data']['show_number'])
            ->withPlayTimes($msgData['ext_data']['play_times'])
            ->withVolume($msgData['ext_data']['volume'])
            ->withSpeed($msgData['ext_data']['speed'])
            ->withOutId($msgData['ext_data']['out_id']);
        $sendRes = $callTts->request()->toArray();
        if ('OK' == $sendRes['Code']) {
            $handleRes['data'] = $sendRes;
        } else {
            $handleRes['code'] = ErrorCode::VMS_REQ_ALIYUN_ERROR;
            $handleRes['msg'] = $sendRes['Message'];
        }

        return $handleRes;
    }
}
