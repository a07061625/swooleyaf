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

/**
 * 获取会话
 * @package DingDing\Corp\Chat
 */
class ChatGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 会话ID
     * @var string
     */
    private $chatid = '';

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

    public function getDetail() : array
    {
        if (!isset($this->reqData['chatid'])) {
            throw new TalkException('会话ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/chat/get?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
