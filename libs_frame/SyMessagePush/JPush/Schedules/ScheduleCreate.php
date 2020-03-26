<?php
/**
 * 创建定时任务
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 15:18
 */
namespace SyMessagePush\JPush\Schedules;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\SchedulesBase;
use SyMessagePush\PushUtilJPush;
use SyTool\Tool;

class ScheduleCreate extends SchedulesBase
{
    /**
     * 推送标识符
     * @var string
     */
    private $cid = '';
    /**
     * 任务名
     * @var string
     */
    private $name = '';
    /**
     * 任务状态
     * @var bool
     */
    private $enabled = true;
    /**
     * 触发条件
     * @var array
     */
    private $trigger = [];
    /**
     * 推送内容
     * @var array
     */
    private $push = [];

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
        $this->serviceUri = '/v3/schedules';
        $this->reqData['enabled'] = true;
    }

    private function __clone()
    {
    }

    /**
     * @param string $cid
     * @throws \SyException\MessagePush\JPushException
     */
    public function setCid(string $cid)
    {
        if (strlen($cid) > 0) {
            $this->reqData['cid'] = $cid;
        } else {
            throw new JPushException('推送标识符不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $name
     * @throws \SyException\MessagePush\JPushException
     */
    public function setName(string $name)
    {
        $length = strlen($name);
        if ($length == 0) {
            throw new JPushException('任务名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        } elseif ($length > 255) {
            throw new JPushException('任务名不能超过255字节', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['name'] = $name;
    }

    /**
     * @param array $trigger
     * @throws \SyException\MessagePush\JPushException
     */
    public function setTrigger(array $trigger)
    {
        if (empty($trigger)) {
            throw new JPushException('触发条件不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['trigger'] = $trigger;
    }

    /**
     * @param array $push
     * @throws \SyException\MessagePush\JPushException
     */
    public function setPush(array $push)
    {
        if (empty($push)) {
            throw new JPushException('推送内容不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['push'] = $push;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['name'])) {
            throw new JPushException('任务名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['trigger'])) {
            throw new JPushException('触发条件不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['push'])) {
            throw new JPushException('推送内容不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->getContent();
    }
}
