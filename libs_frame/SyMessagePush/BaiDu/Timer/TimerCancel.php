<?php
/**
 * 取消定时任务
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 19:02
 */
namespace SyMessagePush\BaiDu\Timer;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;

class TimerCancel extends PushBaseBaiDu
{
    /**
     * 定时任务ID
     * @var string
     */
    private $timer_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/timer/cancel';
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['timer_id'])) {
            throw new BaiDuPushException('定时任务ID不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
