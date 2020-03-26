<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-2
 * Time: 下午1:03
 */
namespace DingDing\Corp\Attendance;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取打卡结果
 * @package DingDing\Corp\Attendance
 */
class AttendanceList extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 员工列表
     * @var array
     */
    private $userIdList = [];
    /**
     * 开始时间
     * @var string
     */
    private $workDateFrom = '';
    /**
     * 结束时间
     * @var string
     */
    private $workDateTo = '';
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

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['userIdList'] = [];
        $this->reqData['offset'] = 0;
        $this->reqData['limit'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param array $userList
     * @throws \SyException\DingDing\TalkException
     */
    public function setUserList(array $userList)
    {
        $users = [];
        foreach ($userList as $eUserId) {
            if (ctype_alnum($eUserId)) {
                $users[$eUserId] = 1;
            }
        }

        $userNum = count($users);
        if ($userNum == 0) {
            throw new TalkException('员工列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        } elseif ($userNum > 50) {
            throw new TalkException('员工不能超过50个', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        $this->reqData['userIdList'] = array_keys($users);
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
        } elseif (($endTime - $startTime) > 604800) {
            throw new TalkException('结束时间不能超过开始时间7天', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['workDateFrom'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['workDateTo'] = date('Y-m-d H:i:s', $endTime);
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

    public function getDetail() : array
    {
        if (empty($this->reqData['userIdList'])) {
            throw new TalkException('员工列表不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['workDateFrom'])) {
            throw new TalkException('开始时间不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/attendance/list?' . http_build_query([
            'access_token' => $this->getAccessToken(TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP, $this->_corpId, $this->_agentTag),
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->sendRequest('POST');
    }
}
