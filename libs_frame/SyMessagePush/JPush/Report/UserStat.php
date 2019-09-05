<?php
/**
 * 用户统计
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 11:27
 */
namespace SyMessagePush\JPush\Report;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\ReportBase;
use SyMessagePush\PushUtilJPush;

class UserStat extends ReportBase
{
    const TIME_UNIT_HOUR = 'HOUR';
    const TIME_UNIT_DAY = 'DAY';
    const TIME_UNIT_MONTH = 'MONTH';

    /**
     * 时间单位
     * @var string
     */
    private $time_unit = '';
    /**
     * 起始时间
     * @var string
     */
    private $start = '';
    /**
     * 持续时长
     * @var int
     */
    private $duration = 0;

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
        $this->serviceUri = '/v3/users';
    }

    private function __clone()
    {
    }

    /**
     * @param string $timeUnit
     * @param int $timeStamp
     * @param int $duration
     * @throws \SyException\MessagePush\JPushException
     */
    public function setStatTime(string $timeUnit, int $timeStamp, int $duration)
    {
        if ($duration <= 0) {
            throw new JPushException('持续时长不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if ($timeUnit == self::TIME_UNIT_HOUR) {
            if ($duration > 24) {
                throw new JPushException('持续时长不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
            }
            $this->reqData['time_unit'] = $timeUnit;
            $this->reqData['start'] = date('Y-m-d H', $timeStamp);
            $this->reqData['duration'] = $duration;
        } elseif ($timeUnit == self::TIME_UNIT_DAY) {
            if ($duration > 60) {
                throw new JPushException('持续时长不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
            }
            $this->reqData['time_unit'] = $timeUnit;
            $this->reqData['start'] = date('Y-m-d', $timeStamp);
            $this->reqData['duration'] = $duration;
        } elseif ($timeUnit == self::TIME_UNIT_MONTH) {
            if ($duration > 2) {
                throw new JPushException('持续时长不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
            }
            $this->reqData['time_unit'] = $timeUnit;
            $this->reqData['start'] = date('Y-m', $timeStamp);
            $this->reqData['duration'] = $duration;
        } else {
            throw new JPushException('时间单位不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['time_unit'])) {
            throw new JPushException('时间单位不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $url = $this->serviceDomain . $this->serviceUri . '?' . http_build_query($this->reqData);
        $this->curlConfigs[CURLOPT_URL] = $url;
        return $this->getContent();
    }
}
