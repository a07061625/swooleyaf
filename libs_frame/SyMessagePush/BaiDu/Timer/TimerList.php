<?php
/**
 * 查询定时任务列表
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 19:02
 */
namespace SyMessagePush\BaiDu\Timer;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;

class TimerList extends PushBaseBaiDu
{
    /**
     * 定时任务ID
     * @var string
     */
    private $timer_id = '';
    /**
     * 起始索引位置
     * @var int
     */
    private $start = 0;
    /**
     * 记录条数
     * @var int
     */
    private $limit = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/timer/query_list';
        $this->reqData['start'] = 0;
        $this->reqData['limit'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param string $timerId
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setTimerId(string $timerId)
    {
        if (ctype_alnum($timerId)) {
            $this->reqData['timer_id'] = $timerId;
        } else {
            throw new BaiDuPushException('定时任务ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $start
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setStart(int $start)
    {
        if ($start >= 0) {
            $this->reqData['start'] = $start;
        } else {
            throw new BaiDuPushException('起始索引位置不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 10)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new BaiDuPushException('记录条数不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
