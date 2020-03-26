<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-3
 * Time: 下午1:45
 */
namespace DingDing\Corp\Chat;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 发送群消息
 * @package DingDing\Corp\Chat
 */
class ChatSend extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 会话ID
     * @var string
     */
    private $chatid = '';
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
     * @param string $chatId
     * @throws \SyException\DingDing\TalkException
     */
    public function setChatId(string $chatId)
    {
        if (ctype_alnum($chatId)) {
            $this->reqData['chatid'] = $chatId;
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
        if (!isset($this->reqData['chatid'])) {
            throw new TalkException('会话ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['msg'])) {
            throw new TalkException('消息内容不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/chat/send?' . http_build_query([
            'access_token' => $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
