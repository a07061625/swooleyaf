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

/**
 * 获取部门用户签到记录
 * @package DingDing\Corp\CheckIn
 */
class Record extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 部门id
     * @var int
     */
    private $department_id = 0;
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
     * 偏移量
     * @var int
     */
    private $offset = 0;
    /**
     * 分页大小
     * @var int
     */
    private $size = 0;
    /**
     * 排序
     * @var string
     */
    private $order = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $this->reqData['offset'] = 0;
        $this->reqData['size'] = 10;
        $this->reqData['order'] = 'desc';
    }

    private function __clone()
    {
    }

    /**
     * @param int $departmentId
     * @throws \SyException\DingDing\TalkException
     */
    public function setDepartmentId(int $departmentId)
    {
        if ($departmentId > 0) {
            $this->reqData['department_id'] = $departmentId;
        } else {
            throw new TalkException('部门id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
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
        } elseif (($endTime - $startTime) > 3888000) {
            throw new TalkException('结束时间不能超过开始时间45天', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['start_time'] = $startTime;
        $this->reqData['end_time'] = $endTime;
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

    /**
     * @param string $order
     * @throws \SyException\DingDing\TalkException
     */
    public function setOrder(string $order)
    {
        if (in_array($order, ['asc', 'desc'], true)) {
            $this->reqData['order'] = $order;
        } else {
            throw new TalkException('排序不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['department_id'])) {
            throw new TalkException('部门id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['start_time'])) {
            throw new TalkException('开始时间不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/checkin/record?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
