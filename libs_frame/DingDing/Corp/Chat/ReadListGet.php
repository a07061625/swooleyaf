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
 * 查询群消息已读人员列表
 * @package DingDing\Corp\Chat
 */
class ReadListGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 消息ID
     * @var string
     */
    private $messageId = '';
    /**
     * 分页游标
     * @var int
     */
    private $cursor = 0;
    /**
     * 分页大小
     * @var int
     */
    private $size = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['cursor'] = 0;
        $this->reqData['size'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param string $messageId
     * @throws \SyException\DingDing\TalkException
     */
    public function setMessageId(string $messageId)
    {
        if (ctype_alnum($messageId)) {
            $this->reqData['messageId'] = $messageId;
        } else {
            throw new TalkException('消息ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $cursor
     * @throws \SyException\DingDing\TalkException
     */
    public function setCursor(int $cursor)
    {
        if ($cursor >= 0) {
            $this->reqData['cursor'] = $cursor;
        } else {
            throw new TalkException('分页游标不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $size
     * @throws \SyException\DingDing\TalkException
     */
    public function setSize(int $size)
    {
        if ($size > 0) {
            $this->reqData['size'] = $size > 100 ? 100 : $size;
        } else {
            throw new TalkException('分页大小不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['messageId'])) {
            throw new TalkException('消息ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/chat/getReadList?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
