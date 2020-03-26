<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-3
 * Time: 下午12:51
 */
namespace DingDing\Corp\Message;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 发送普通消息
 * @package DingDing\Corp\Message
 */
class ConversationSend extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 发送者
     * @var string
     */
    private $sender = '';
    /**
     * 会话ID
     * @var string
     */
    private $cid = '';
    /**
     * 消息内容
     * @var string
     */
    private $msg = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
    }

    /**
     * @param string $sender
     * @throws \SyException\DingDing\TalkException
     */
    public function setSender(string $sender)
    {
        if (ctype_alnum($sender)) {
            $this->reqData['sender'] = $sender;
        } else {
            throw new TalkException('发送者不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $cid
     * @throws \SyException\DingDing\TalkException
     */
    public function setCid(string $cid)
    {
        if (ctype_alnum($cid)) {
            $this->reqData['cid'] = $cid;
        } else {
            throw new TalkException('会话ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $type
     * @param array $data
     * @throws \SyException\DingDing\TalkException
     */
    public function setMsgData(string $type, array $data)
    {
        if (!isset(self::$totalMessageType[$type])) {
            throw new TalkException('消息类型不支持', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif (empty($data)) {
            throw new TalkException('消息数据不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['msg'] = [
            'msgtype' => $type,
            $type => $data,
        ];
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['sender'])) {
            throw new TalkException('发送者不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['cid'])) {
            throw new TalkException('会话ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['msg'])) {
            throw new TalkException('消息内容不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/message/send_to_conversation?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
