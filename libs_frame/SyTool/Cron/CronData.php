<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/7/29 0029
 * Time: 16:02
 */
namespace SyTool\Cron;

use SyConstant\ErrorCode;
use SyException\Cron\CronException;
use SyTool\Tool;

class CronData
{
    /**
     * 允许的秒钟值
     * @var array
     */
    private $acceptSeconds = [];
    /**
     * 允许的分钟值
     * @var array
     */
    private $acceptMinutes = [];
    /**
     * 允许的小时值
     * @var array
     */
    private $acceptHours = [];
    /**
     * 允许的日期值
     * @var array
     */
    private $acceptDays = [];
    /**
     * 允许的月份值
     * @var array
     */
    private $acceptMonths = [];
    /**
     * 允许的星期值
     * @var array
     */
    private $acceptWeeks = [];
    /**
     * 定时任务计划
     * @var string
     */
    private $cron = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __toString()
    {
        return Tool::jsonEncode($this->getDetail(), JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return array
     */
    public function getSeconds() : array
    {
        return $this->acceptSeconds;
    }

    /**
     * @param array $seconds
     * @throws \SyException\Cron\CronException
     */
    public function setSeconds(array $seconds)
    {
        $checkRes = CronTool::checkSeconds($seconds);
        if (!is_array($checkRes)) {
            throw new CronException('秒值不合法', ErrorCode::CRON_SECOND_ERROR);
        }

        $this->acceptSeconds = $checkRes;
    }

    /**
     * @return array
     */
    public function getMinutes() : array
    {
        return $this->acceptMinutes;
    }

    /**
     * @param array $minutes
     * @throws \SyException\Cron\CronException
     */
    public function setMinutes(array $minutes)
    {
        $checkRes = CronTool::checkMinutes($minutes);
        if (!is_array($checkRes)) {
            throw new CronException('分钟值不合法', ErrorCode::CRON_MINUTE_ERROR);
        }

        $this->acceptMinutes = $checkRes;
    }

    /**
     * @return array
     */
    public function getHours() : array
    {
        return $this->acceptHours;
    }

    /**
     * @param array $hours
     * @throws \SyException\Cron\CronException
     */
    public function setHours(array $hours)
    {
        $checkRes = CronTool::checkHours($hours);
        if (!is_array($checkRes)) {
            throw new CronException('小时值不合法', ErrorCode::CRON_HOUR_ERROR);
        }

        $this->acceptHours = $checkRes;
    }

    /**
     * @return array
     */
    public function getDays() : array
    {
        return $this->acceptDays;
    }

    /**
     * @param array $days
     * @throws \SyException\Cron\CronException
     */
    public function setDays(array $days)
    {
        $checkRes = CronTool::checkDays($days);
        if (!is_array($checkRes)) {
            throw new CronException('日期值不合法', ErrorCode::CRON_DAY_ERROR);
        }

        $this->acceptDays = $checkRes;
    }

    /**
     * @return array
     */
    public function getMonths() : array
    {
        return $this->acceptMonths;
    }

    /**
     * @param array $months
     * @throws \SyException\Cron\CronException
     */
    public function setMonths(array $months)
    {
        $checkRes = CronTool::checkMonths($months);
        if (!is_array($checkRes)) {
            throw new CronException('月份值不合法', ErrorCode::CRON_MONTH_ERROR);
        }

        $this->acceptMonths = $checkRes;
    }

    /**
     * @return array
     */
    public function getWeeks() : array
    {
        return $this->acceptWeeks;
    }

    /**
     * @param array $weeks
     * @throws \SyException\Cron\CronException
     */
    public function setWeeks(array $weeks)
    {
        $checkRes = CronTool::checkWeeks($weeks);
        if (!is_array($checkRes)) {
            throw new CronException('星期值不合法', ErrorCode::CRON_WEEK_ERROR);
        }

        $this->acceptWeeks = $checkRes;
    }

    /**
     * @return string
     */
    public function getCron() : string
    {
        return $this->cron;
    }

    /**
     * @param string $cron
     * @throws \SyException\Cron\CronException
     */
    public function setCron(string $cron)
    {
        if (preg_match('/^(\s{1}(\*|\d+(\,\d+)*|\d+\-\d+(\,\d+\-\d+)*)(\/\d+){0,1}){6}$/', ' ' . $cron) == 0) {
            throw new CronException('cron格式不合法', ErrorCode::CRON_FORMAT_ERROR);
        }

        $this->cron = preg_replace('/\s+/', ' ', $cron);
    }

    /**
     * @return array
     */
    public function getDetail()
    {
        return [
            'cron' => $this->cron,
            'seconds' => $this->acceptSeconds,
            'minutes' => $this->acceptMinutes,
            'hours' => $this->acceptHours,
            'days' => $this->acceptDays,
            'months' => $this->acceptMonths,
            'weeks' => $this->acceptWeeks,
        ];
    }

    /**
     * @param int $second
     * @return bool
     */
    public function checkSecond(int $second) : bool
    {
        return in_array($second, $this->acceptSeconds, true);
    }

    /**
     * @param int $minute
     * @return bool
     */
    public function checkMinute(int $minute) : bool
    {
        return in_array($minute, $this->acceptMinutes, true);
    }

    /**
     * @param int $hour
     * @return bool
     */
    public function checkHour(int $hour) : bool
    {
        return in_array($hour, $this->acceptHours, true);
    }

    /**
     * @param int $day
     * @return bool
     */
    public function checkDay(int $day) : bool
    {
        return in_array($day, $this->acceptDays, true);
    }

    /**
     * @param int $month
     * @return bool
     */
    public function checkMonth(int $month) : bool
    {
        return in_array($month, $this->acceptMonths, true);
    }

    /**
     * @param int $week
     * @return bool
     */
    public function checkWeek(int $week) : bool
    {
        return in_array($week, $this->acceptWeeks, true);
    }

    /**
     * 校验时间戳是否满足cron计划
     * @param array $timeArr
     * @return bool
     */
    public function checkTime(array $timeArr) : bool
    {
        if (empty($timeArr)) {
            return false;
        }

        if (!$this->checkSecond($timeArr['second'])) {
            return false;
        }
        if (!$this->checkMinute($timeArr['minute'])) {
            return false;
        }
        if (!$this->checkHour($timeArr['hour'])) {
            return false;
        }
        if (!$this->checkDay($timeArr['day'])) {
            return false;
        }
        if (!$this->checkMonth($timeArr['month'])) {
            return false;
        }
        if (!$this->checkWeek($timeArr['week'])) {
            return false;
        }

        return true;
    }
}
