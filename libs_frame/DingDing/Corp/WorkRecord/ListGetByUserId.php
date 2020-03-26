<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-2
 * Time: 下午2:23
 */
namespace DingDing\Corp\WorkRecord;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取用户待办事项
 * @package DingDing\Corp\WorkRecord
 */
class ListGetByUserId extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 用户ID
     * @var string
     */
    private $userid = '';
    /**
     * 偏移量
     * @var int
     */
    private $offset = 0;
    /**
     * 分页大小
     * @var int
     */
    private $limit = 0;
    /**
     * 待办状态 0:未完成 1:完成
     * @var int
     */
    private $status = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['offset'] = 0;
        $this->reqData['limit'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param string $userId
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserId(string $userId)
    {
        if (ctype_alnum($userId)) {
            $this->reqData['userid'] = $userId;
        } else {
            throw new TalkException('用户ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $offset
     * @throws \SyException\DingDing\TalkException
     */
    public function setOffset(int $offset)
    {
        if ($offset >= 0) {
            $this->reqData['offset'] = $offset;
        } else {
            throw new TalkException('偏移量不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\DingDing\TalkException
     */
    public function setLimit(int $limit)
    {
        if ($limit > 0) {
            $this->reqData['limit'] = $limit > 50 ? 50 : $limit;
        } else {
            throw new TalkException('分页大小不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $status
     * @throws \SyException\DingDing\TalkException
     */
    public function setStatus(int $status)
    {
        if (in_array($status, [0, 1], true)) {
            $this->reqData['status'] = $status;
        } else {
            throw new TalkException('待办状态不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['userid'])) {
            throw new TalkException('用户ID不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['status'])) {
            throw new TalkException('待办状态不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/workrecord/getbyuserid?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
