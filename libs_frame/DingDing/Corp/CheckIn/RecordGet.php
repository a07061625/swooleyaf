<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-30
 * Time: 下午12:43
 */
namespace DingDing\Corp\CheckIn;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取用户签到记录
 * @package DingDing\Corp\CheckIn
 */
class RecordGet extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 用户列表
     * @var string
     */
    private $userid_list = '';
    /**
     * 开始时间
     * @var int
     */
    private $start_time = 0;
    /**
     * 结束时间
     * @var int
     */
    private $end_time = 0;
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
     * @param array $userIdList
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserIdList(array $userIdList)
    {
        $users = [];
        foreach ($userIdList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $users[$eUserId] = 1;
            }
        }

        if (count($users) > 10) {
            throw new TalkException('用户不能超过10个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['userid_list'] = implode(',', array_keys($users));
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\DingDing\TalkException
     */
    public function setStartTimeAndEndTime(int $startTime, int $endTime)
    {
        if ($startTime < 946656000) {
            throw new TalkException('开始时间不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($endTime < $startTime) {
            throw new TalkException('结束时间不能小于开始时间', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif (($endTime - $startTime) > 864000) {
            throw new TalkException('结束时间不能超过开始时间10天', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['start_time'] = $startTime;
        $this->reqData['end_time'] = $endTime;
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
        if (!isset($this->reqData['userid_list'])) {
            throw new TalkException('用户列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['start_time'])) {
            throw new TalkException('开始时间不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/topapi/checkin/record/get?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
