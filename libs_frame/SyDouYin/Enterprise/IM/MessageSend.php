<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */

namespace SyDouYin\Enterprise\IM;

use SyConstant\ErrorCode;
use SyDouYin\BaseEnterprise;
use SyDouYin\TraitOpenId;
use SyDouYin\Util;
use SyException\DouYin\DouYinEnterpriseException;
use SyTool\Tool;

/**
 * 企业发送私信至抖音用户
 *
 * @package SyDouYin\Enterprise\IM
 */
class MessageSend extends BaseEnterprise
{
    use TraitOpenId;

    private static $msgTypeMap = [
        'text' => 'setMessageText',
        'image' => 'setMessageImage',
        'video' => 'setMessageVideo',
        'card' => 'setMessageCard',
    ];

    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceUri = '/enterprise/im/message/send/';
    }

    private function __clone()
    {
    }

    /**
     * @param string $clientMsgId 消息id
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setClientMsgId(string $clientMsgId)
    {
        if (\strlen($clientMsgId) > 0) {
            $this->reqData['client_msg_id'] = $clientMsgId;
        } else {
            throw new DouYinEnterpriseException('消息id不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    /**
     * @param string $type    消息内容格式
     * @param string $content 消息内容
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setMessage(string $type, string $content)
    {
        $funcName = Tool::getArrayVal(self::$msgTypeMap, $type, null);
        if (null === $funcName) {
            throw new DouYinEnterpriseException('消息内容格式不支持', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }

        $this->{$funcName}($content);
        $this->reqData['message_type'] = $type;
    }

    /**
     * @param string $personaId 客服id
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setPersonaId(string $personaId)
    {
        if (\strlen($personaId) > 0) {
            $this->reqData['persona_id'] = $personaId;
        } else {
            throw new DouYinEnterpriseException('客服id不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    /**
     * @param string $userId 接收方openid
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    public function setUserId(string $userId)
    {
        if (\strlen($userId) > 0) {
            $this->reqData['to_user_id'] = $userId;
        } else {
            throw new DouYinEnterpriseException('接收方openid不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['open_id'])) {
            throw new DouYinEnterpriseException('用户openid不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
        if (!isset($this->reqData['message_type'])) {
            throw new DouYinEnterpriseException('消息内容格式不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
        if (!isset($this->reqData['to_user_id'])) {
            throw new DouYinEnterpriseException('接收方openid不能为空', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }

        $this->serviceUri .= '?' . http_build_query([
            'open_id' => $this->reqData['open_id'],
            'access_token' => Util::getAccessToken([
                'client_key' => $this->clientKey,
                'host_type' => $this->serviceHostType,
                'open_id' => $this->reqData['open_id'],
            ]),
        ]);
        unset($this->reqData['open_id']);
        $this->getContent();
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json',
        ];
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->curlConfigs;
    }

    /**
     * @param string $text 文字内容
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    private function setMessageText(string $text)
    {
        if (\strlen($text) > 0) {
            $this->reqData['content'] = Tool::jsonEncode([
                'text' => $text,
            ], JSON_UNESCAPED_UNICODE);
        } else {
            throw new DouYinEnterpriseException('文字内容不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    /**
     * @param string $mediaId 素材id
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    private function setMessageImage(string $mediaId)
    {
        if (\strlen($mediaId) > 0) {
            $this->reqData['content'] = Tool::jsonEncode([
                'media_id' => $mediaId,
            ], JSON_UNESCAPED_UNICODE);
        } else {
            throw new DouYinEnterpriseException('素材id不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    /**
     * @param string $itemId 视频id
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    private function setMessageVideo(string $itemId)
    {
        if (\strlen($itemId) > 0) {
            $this->reqData['content'] = Tool::jsonEncode([
                'item_id' => $itemId,
            ], JSON_UNESCAPED_UNICODE);
        } else {
            throw new DouYinEnterpriseException('视频id不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }

    /**
     * @param string $cardId 卡片id
     *
     * @throws \SyException\DouYin\DouYinEnterpriseException
     */
    private function setMessageCard(string $cardId)
    {
        if (\strlen($cardId) > 0) {
            $this->reqData['content'] = Tool::jsonEncode([
                'card_id' => $cardId,
            ], JSON_UNESCAPED_UNICODE);
        } else {
            throw new DouYinEnterpriseException('卡片id不合法', ErrorCode::DOUYIN_ENTERPRISE_PARAM_ERROR);
        }
    }
}
