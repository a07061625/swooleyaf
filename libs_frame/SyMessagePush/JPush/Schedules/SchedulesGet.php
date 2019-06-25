<?php
/**
 * 获取指定的定时任务
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 16:25
 */
namespace SyMessagePush\JPush\Schedules;

use Constant\ErrorCode;
use Exception\MessagePush\JPushException;
use SyMessagePush\JPush\SchedulesBase;

class SchedulesGet extends SchedulesBase
{
    /**
     * 任务ID
     * @var string
     */
    private $schedule_id = '';

    public function __construct()
    {
        parent::__construct('app');
        $this->reqMethod = self::REQ_METHOD_GET;
        $this->serviceUri = '/v1/app';
    }

    private function __clone()
    {
    }

    /**
     * @param string $scheduleId
     * @throws \Exception\MessagePush\JPushException
     */
    public function setScheduleId(string $scheduleId)
    {
        if (strlen($scheduleId) > 0) {
            $this->schedule_id = $scheduleId;
            $this->serviceUri = '/v3/schedules/' . $scheduleId;
        } else {
            throw new JPushException('任务ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }



    public function getDetail() : array
    {
        if (strlen($this->schedule_id) == 0) {
            throw new JPushException('任务ID不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
