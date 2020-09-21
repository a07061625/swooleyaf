<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/21 0021
 * Time: 15:33
 */
namespace SyVms\XunFei\AiCall;

use SyConstant\ErrorCode;
use SyException\Vms\XunFeiException;
use SyVms\BaseXunFeiAiCall;
use SyVms\UtilXunFei;

/**
 * 创建外呼任务
 *
 * @package SyVms\XunFei\AiCall
 */
class OutboundTaskCreate extends BaseXunFeiAiCall
{
    /**
     * 任务名称
     *
     * @var string
     */
    private $task_name = '';
    /**
     * 线路号码
     *
     * @var array
     */
    private $line_num = [];
    /**
     * 话术id
     *
     * @var string
     */
    private $robot_id = '';
    /**
     * 重试外呼次数
     *
     * @var int
     */
    private $recall_count = 0;
    /**
     * 重试等待时间,单位秒
     *
     * @var int
     */
    private $time_recall_wait = 0;
    /**
     * 外呼时间段
     *
     * @var array
     */
    private $time_range = [];
    /**
     * 任务开始时间
     *
     * @var int
     */
    private $time_begin = 0;
    /**
     * 任务结束时间
     *
     * @var int
     */
    private $time_end = 0;
    /**
     * 发音人编码
     *
     * @var string
     */
    private $voice_code = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://callapi.xfyun.cn/v1/service/v1/aicall/outbound/v1/task/create?token=';
        $this->reqData = [
            'recall_count' => 0,
            'time_range' => [],
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param string $taskName
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setTaskName(string $taskName)
    {
        if (strlen($taskName) > 0) {
            $this->reqData['task_name'] = $taskName;
        } else {
            throw new XunFeiException('任务名称不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param array $lineNum
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setLineNum(array $lineNum)
    {
        $numList = [];
        foreach ($lineNum as $eNum) {
            if (is_string($eNum) && ctype_digit($eNum)) {
                $numList[$eNum] = 1;
            }
        }
        if (empty($numList)) {
            throw new XunFeiException('线路号码不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        $this->reqData['line_num'] = implode(',', array_keys($numList));
    }

    /**
     * @param string $robotId
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setRobotId(string $robotId)
    {
        if (strlen($robotId) > 0) {
            $this->reqData['robot_id'] = $robotId;
        } else {
            throw new XunFeiException('话术id不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param int $recallCount
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setRecallCount(int $recallCount)
    {
        if (($recallCount > 0) && ($recallCount <= 3)) {
            $this->reqData['recall_count'] = $recallCount;
        } else {
            throw new XunFeiException('重试外呼次数不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param int $timeRecallWait
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setTimeRecallWait(int $timeRecallWait)
    {
        if ($timeRecallWait >= 0) {
            $this->reqData['time_recall_wait'] = $timeRecallWait;
        } else {
            throw new XunFeiException('重试等待时间不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    /**
     * @param array $timeRange
     */
    public function setTimeRange(array $timeRange)
    {
        $this->reqData['time_range'] = [];
        foreach ($timeRange as $eTime) {
            if (is_string($eTime) && (strlen($eTime) > 0)) {
                $this->reqData['time_range'][] = $eTime;
            }
        }
    }

    /**
     * @param int $timeBegin 毫秒级开始时间
     * @param int $timeEnd   毫秒级结束时间
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setTime(int $timeBegin, int $timeEnd)
    {
        if ($timeBegin <= 1577808000000) {
            throw new XunFeiException('任务开始时间不合法', ErrorCode::VMS_PARAM_ERROR);
        } elseif ($timeEnd < $timeBegin) {
            throw new XunFeiException('	任务结束时间不合法', ErrorCode::VMS_PARAM_ERROR);
        }
        $this->reqData['time_begin'] = $timeBegin;
        $this->reqData['time_end'] = $timeEnd;
    }

    /**
     * @param string $voiceCode
     *
     * @throws \SyException\Vms\XunFeiException
     */
    public function setVoiceCode(string $voiceCode)
    {
        if (ctype_digit($voiceCode)) {
            $this->reqData['voice_code'] = $voiceCode;
        } else {
            throw new XunFeiException('发音人编码不合法', ErrorCode::VMS_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['task_name'])) {
            throw new XunFeiException('任务名称不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['line_num'])) {
            throw new XunFeiException('线路号码不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['robot_id'])) {
            throw new XunFeiException('话术id不能为空', ErrorCode::VMS_PARAM_ERROR);
        }
        if (!isset($this->reqData['time_begin'])) {
            throw new XunFeiException('任务开始时间不能为空', ErrorCode::VMS_PARAM_ERROR);
        }

        $this->getContent();
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . UtilXunFei::getAiCallToken();

        return $this->curlConfigs;
    }
}
