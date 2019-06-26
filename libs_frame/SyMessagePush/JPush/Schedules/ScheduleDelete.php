<?php
/**
 * 删除定时任务
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 15:18
 */
namespace SyMessagePush\JPush\Schedules;

use Constant\ErrorCode;
use Exception\MessagePush\JPushException;
use SyMessagePush\JPush\SchedulesBase;
use SyMessagePush\PushUtilJPush;

class ScheduleDelete extends SchedulesBase
{
    /**
     * 任务ID
     * @var string
     */
    private $schedule_id = '';

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
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

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        return $this->getContent();
    }
}
