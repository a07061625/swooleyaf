<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Tool;

use SyConstant\ErrorCode;
use SyDouYin\BaseTool;
use SyDouYin\Util;
use SyException\DouYin\DouYinToolException;
use SyTool\Tool;

/**
 * 模拟webhook事件
 *
 * @package SyDouYin\Tool
 */
class WebhookEventSend extends BaseTool
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/sandbox/webhook/event/send/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $eventType 事件类型
     *
     * @throws \SyException\DouYin\DouYinToolException
     */
    public function setEventType(string $eventType)
    {
        $allEvents = [
            'create_video' => 1,
            'authorize' => 1,
            'receive_msg' => 1,
            'enter_im' => 1,
            'dial_phone' => 1,
            'website_contact' => 1,
            'personal_tab_contact' => 1,
            'verify_webhook' => 1,
        ];
        if (isset($allEvents[$eventType])) {
            $this->reqData['event_type'] = $eventType;
        } else {
            throw new DouYinToolException('事件类型不合法', ErrorCode::DOUYIN_TOOL_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['event_type'])) {
            throw new DouYinToolException('事件类型不能为空', ErrorCode::DOUYIN_TOOL_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query([
            'access_token' => Util::getClientToken($this->clientKey, $this->serviceHostType),
        ]);
        $this->getContent();
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
        ];
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->curlConfigs;
    }
}
