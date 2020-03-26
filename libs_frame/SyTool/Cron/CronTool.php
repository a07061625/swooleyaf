<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/7/29 0029
 * Time: 15:43
 */
namespace SyTool\Cron;

use SyConstant\ErrorCode;
use SyException\Cron\CronException;
use SyTrait\SimpleTrait;

class CronTool
{
    use SimpleTrait;

    const DATA_TYPE_ALL = 1; //数据类型-所有数据
    const DATA_TYPE_SINGLE = 2; //数据类型-单个数值
    const DATA_TYPE_RANGE = 3; //数据类型-取值范围

    /**
     * 合法的秒钟值
     * @var array
     */
    private static $totalSeconds = [
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
        10, 11, 12, 13, 14, 15, 16, 17, 18, 19,
        20, 21, 22, 23, 24, 25, 26, 27, 28, 29,
        30, 31, 32, 33, 34, 35, 36, 37, 38, 39,
        40, 41, 42, 43, 44, 45, 46, 47, 48, 49,
        50, 51, 52, 53, 54, 55, 56, 57, 58, 59,
    ];
    /**
     * 合法的分钟值
     * @var array
     */
    private static $totalMinutes = [
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
        10, 11, 12, 13, 14, 15, 16, 17, 18, 19,
        20, 21, 22, 23, 24, 25, 26, 27, 28, 29,
        30, 31, 32, 33, 34, 35, 36, 37, 38, 39,
        40, 41, 42, 43, 44, 45, 46, 47, 48, 49,
        50, 51, 52, 53, 54, 55, 56, 57, 58, 59,
    ];
    /**
     * 合法的小时值
     * @var array
     */
    private static $totalHours = [
        0, 1, 2, 3, 4,
        5, 6, 7, 8, 9,
        10, 11, 12, 13, 14,
        15, 16, 17, 18, 19,
        20, 21, 22, 23,
    ];
    /**
     * 合法的日期值
     * @var array
     */
    private static $totalDays = [
        1, 2, 3, 4, 5,
        6, 7, 8, 9, 10,
        11, 12, 13, 14, 15,
        16, 17, 18, 19, 20,
        21, 22, 23, 24, 25,
        26, 27, 28, 29, 30,
        31,
    ];
    /**
     * 合法的月份值
     * @var array
     */
    private static $totalMonths = [
        1, 2, 3, 4, 5, 6,
        7, 8, 9, 10, 11, 12,
    ];
    /**
     * 合法的星期值
     * @var array
     */
    private static $totalWeeks = [
        0, 1, 2, 3, 4, 5, 6,
    ];

    /**
     * @param array $seconds
     * @return array|bool
     */
    public static function checkSeconds(array $seconds)
    {
        array_unique($seconds);
        if (empty($seconds) || (count($seconds) > 60)) {
            return false;
        }

        $resArr = [];
        foreach ($seconds as $second) {
            if (!in_array($second, self::$totalSeconds, true)) {
                return false;
            }

            $resArr[] = $second;
        }

        sort($resArr);
        return $resArr;
    }

    /**
     * @param array $minutes
     * @return array|bool
     */
    public static function checkMinutes(array $minutes)
    {
        array_unique($minutes);
        if (empty($minutes) || (count($minutes) > 60)) {
            return false;
        }

        $resArr = [];
        foreach ($minutes as $minute) {
            if (!in_array($minute, self::$totalMinutes, true)) {
                return false;
            }

            $resArr[] = $minute;
        }

        sort($resArr);
        return $resArr;
    }

    /**
     * @param array $hours
     * @return array|bool
     */
    public static function checkHours(array $hours)
    {
        array_unique($hours);
        if (empty($hours) || (count($hours) > 24)) {
            return false;
        }

        $resArr = [];
        foreach ($hours as $hour) {
            if (!in_array($hour, self::$totalHours, true)) {
                return false;
            }

            $resArr[] = $hour;
        }

        sort($resArr);
        return $resArr;
    }

    /**
     * @param array $days
     * @return array|bool
     */
    public static function checkDays(array $days)
    {
        array_unique($days);
        if (empty($days) || (count($days) > 31)) {
            return false;
        }

        $resArr = [];
        foreach ($days as $day) {
            if (!in_array($day, self::$totalDays, true)) {
                return false;
            }

            $resArr[] = $day;
        }

        sort($resArr);
        return $resArr;
    }

    /**
     * @param array $months
     * @return array|bool
     */
    public static function checkMonths(array $months)
    {
        array_unique($months);
        if (empty($months) || (count($months) > 12)) {
            return false;
        }

        $resArr = [];
        foreach ($months as $month) {
            if (!in_array($month, self::$totalMonths, true)) {
                return false;
            }

            $resArr[] = $month;
        }

        sort($resArr);
        return $resArr;
    }

    /**
     * @param array $weeks
     * @return array|bool
     */
    public static function checkWeeks(array $weeks)
    {
        array_unique($weeks);
        if (empty($weeks) || (count($weeks) > 7)) {
            return false;
        }

        $resArr = [];
        foreach ($weeks as $week) {
            if (!in_array($week, self::$totalWeeks, true)) {
                return false;
            }

            $resArr[] = $week;
        }

        sort($resArr);
        return $resArr;
    }

    /**
     * @param string $cron
     * @return \SyTool\Cron\CronData
     * @throws \SyException\Cron\CronException
     */
    public static function analyseCron(string $cron)
    {
        $cronStr = preg_replace('/\s+/', '=', trim($cron));
        if (preg_match('/^(\=(\*|\d+(\,\d+)*|\d+\-\d+(\,\d+\-\d+)*)(\/\d+){0,1}){6}$/', '=' . $cronStr) == 0) {
            throw new CronException('cron格式不合法', ErrorCode::CRON_FORMAT_ERROR);
        }

        $cronArr = explode('=', $cronStr);
        $handleRes = self::handleCron($cronArr);

        $cronData = new CronData();
        $cronData->setCron(preg_replace('/\=/', ' ', $cronStr));
        $cronData->setSeconds(self::analyseCronSecond($handleRes['second']));
        $cronData->setMinutes(self::analyseCronMinute($handleRes['minute']));
        $cronData->setHours(self::analyseCronHour($handleRes['hour']));
        $cronData->setDays(self::analyseCronDay($handleRes['day']));
        $cronData->setMonths(self::analyseCronMonth($handleRes['month']));
        $cronData->setWeeks(self::analyseCronWeek($handleRes['week']));

        return $cronData;
    }

    /**
     * @param array $cronData
     * @return array
     */
    private static function handleCron(array $cronData) : array
    {
        $resArr = [];
        $keys = [
            'second',
            'minute',
            'hour',
            'day',
            'month',
            'week',
        ];

        for ($i = 0; $i < 6; $i++) {
            $data = [];
            $needArr1 = explode('/', $cronData[$i]);
            $data['num'] = count($needArr1) == 1 ? 1 : (int)$needArr1[1];
            $needArr2 = explode(',', $needArr1[0]);
            if ($needArr2[0] == '*') {
                $data['type'] = self::DATA_TYPE_ALL;
                $data['data'] = ['*'];
            } elseif (is_numeric($needArr2[0])) {
                $data['type'] = self::DATA_TYPE_SINGLE;
                $save = [];
                foreach ($needArr2 as $eNeed) {
                    $save[] = (int)$eNeed;
                }
                array_unique($save);
                $data['data'] = $save;
            } else {
                $data['type'] = self::DATA_TYPE_RANGE;
                $data['data'] = [];
                foreach ($needArr2 as $eNeed) {
                    $needArr3 = explode('-', $eNeed);
                    $data['data'][] = [
                        'min' => (int)$needArr3[0],
                        'max' => (int)$needArr3[1],
                    ];
                }
            }

            $resArr[$keys[$i]] = $data;
        }

        return $resArr;
    }

    /**
     * @param array $secondData
     * @return array
     * @throws \SyException\Cron\CronException
     */
    private static function analyseCronSecond(array $secondData)
    {
        if (($secondData['num'] <= 0) || ($secondData['num'] > 60)) {
            throw new CronException('秒钟格式不合法', ErrorCode::CRON_SECOND_ERROR);
        }

        $resArr = [];
        switch ($secondData['type']) {
            case self::DATA_TYPE_ALL:
                foreach (self::$totalSeconds as $eSecond) {
                    if (($eSecond % $secondData['num']) == 0) {
                        $resArr[] = $eSecond;
                    }
                }
                break;
            case self::DATA_TYPE_SINGLE:
                $totalSeconds = self::checkSeconds($secondData['data']);
                if ($totalSeconds === false) {
                    throw new CronException('秒钟格式不合法', ErrorCode::CRON_SECOND_ERROR);
                }

                foreach ($totalSeconds as $eSecond) {
                    if (($eSecond % $secondData['num']) == 0) {
                        $resArr[] = $eSecond;
                    }
                }
                break;
            case self::DATA_TYPE_RANGE:
                foreach ($secondData['data'] as $eData) {
                    if ($eData['min'] < 0) {
                        throw new CronException('秒钟格式不合法', ErrorCode::CRON_SECOND_ERROR);
                    } elseif ($eData['min'] >= 60) {
                        throw new CronException('秒钟格式不合法', ErrorCode::CRON_SECOND_ERROR);
                    } elseif ($eData['max'] < 0) {
                        throw new CronException('秒钟格式不合法', ErrorCode::CRON_SECOND_ERROR);
                    } elseif ($eData['max'] >= 60) {
                        throw new CronException('秒钟格式不合法', ErrorCode::CRON_SECOND_ERROR);
                    } elseif ($eData['min'] > $eData['max']) {
                        throw new CronException('秒钟格式不合法', ErrorCode::CRON_SECOND_ERROR);
                    }

                    for ($i = $eData['min']; $i <= $eData['max']; $i++) {
                        if (($i % $secondData['num']) == 0) {
                            $resArr[] = $i;
                        }
                    }
                }
                break;
            default:
                break;
        }

        if (empty($resArr)) {
            throw new CronException('秒钟格式不合法', ErrorCode::CRON_SECOND_ERROR);
        }
        array_unique($resArr);

        return $resArr;
    }

    /**
     * @param array $minuteData
     * @return array
     * @throws \SyException\Cron\CronException
     */
    private static function analyseCronMinute(array $minuteData)
    {
        if (($minuteData['num'] <= 0) || ($minuteData['num'] > 60)) {
            throw new CronException('分钟格式不合法', ErrorCode::CRON_MINUTE_ERROR);
        }

        $resArr = [];
        switch ($minuteData['type']) {
            case self::DATA_TYPE_ALL:
                foreach (self::$totalMinutes as $eMinute) {
                    if (($eMinute % $minuteData['num']) == 0) {
                        $resArr[] = $eMinute;
                    }
                }
                break;
            case self::DATA_TYPE_SINGLE:
                $totalMinutes = self::checkMinutes($minuteData['data']);
                if ($totalMinutes === false) {
                    throw new CronException('分钟格式不合法', ErrorCode::CRON_MINUTE_ERROR);
                }

                foreach ($totalMinutes as $eMinute) {
                    if (($eMinute % $minuteData['num']) == 0) {
                        $resArr[] = $eMinute;
                    }
                }
                break;
            case self::DATA_TYPE_RANGE:
                foreach ($minuteData['data'] as $eData) {
                    if ($eData['min'] < 0) {
                        throw new CronException('分钟格式不合法', ErrorCode::CRON_MINUTE_ERROR);
                    } elseif ($eData['min'] >= 60) {
                        throw new CronException('分钟格式不合法', ErrorCode::CRON_MINUTE_ERROR);
                    } elseif ($eData['max'] < 0) {
                        throw new CronException('分钟格式不合法', ErrorCode::CRON_MINUTE_ERROR);
                    } elseif ($eData['max'] >= 60) {
                        throw new CronException('分钟格式不合法', ErrorCode::CRON_MINUTE_ERROR);
                    } elseif ($eData['min'] > $eData['max']) {
                        throw new CronException('分钟格式不合法', ErrorCode::CRON_MINUTE_ERROR);
                    }

                    for ($i = $eData['min']; $i <= $eData['max']; $i++) {
                        if (($i % $minuteData['num']) == 0) {
                            $resArr[] = $i;
                        }
                    }
                }
                break;
            default:
                break;
        }

        if (empty($resArr)) {
            throw new CronException('分钟格式不合法', ErrorCode::CRON_MINUTE_ERROR);
        }
        array_unique($resArr);

        return $resArr;
    }

    /**
     * @param array $hourData
     * @return array
     * @throws \SyException\Cron\CronException
     */
    private static function analyseCronHour(array $hourData)
    {
        if (($hourData['num'] <= 0) || ($hourData['num'] > 24)) {
            throw new CronException('小时格式不合法', ErrorCode::CRON_HOUR_ERROR);
        }

        $resArr = [];
        switch ($hourData['type']) {
            case self::DATA_TYPE_ALL:
                foreach (self::$totalHours as $eHour) {
                    if (($eHour % $hourData['num']) == 0) {
                        $resArr[] = $eHour;
                    }
                }
                break;
            case self::DATA_TYPE_SINGLE:
                $totalHours = self::checkHours($hourData['data']);
                if ($totalHours === false) {
                    throw new CronException('小时格式不合法', ErrorCode::CRON_HOUR_ERROR);
                }

                foreach ($totalHours as $eHour) {
                    if (($eHour % $hourData['num']) == 0) {
                        $resArr[] = $eHour;
                    }
                }
                break;
            case self::DATA_TYPE_RANGE:
                foreach ($hourData['data'] as $eData) {
                    if ($eData['min'] < 0) {
                        throw new CronException('小时格式不合法', ErrorCode::CRON_HOUR_ERROR);
                    } elseif ($eData['min'] >= 24) {
                        throw new CronException('小时格式不合法', ErrorCode::CRON_HOUR_ERROR);
                    } elseif ($eData['max'] < 0) {
                        throw new CronException('小时格式不合法', ErrorCode::CRON_HOUR_ERROR);
                    } elseif ($eData['max'] >= 24) {
                        throw new CronException('小时格式不合法', ErrorCode::CRON_HOUR_ERROR);
                    } elseif ($eData['min'] > $eData['max']) {
                        throw new CronException('小时格式不合法', ErrorCode::CRON_HOUR_ERROR);
                    }

                    for ($i = $eData['min']; $i <= $eData['max']; $i++) {
                        if (($i % $hourData['num']) == 0) {
                            $resArr[] = $i;
                        }
                    }
                }
                break;
            default:
                break;
        }

        if (empty($resArr)) {
            throw new CronException('小时格式不合法', ErrorCode::CRON_HOUR_ERROR);
        }
        array_unique($resArr);

        return $resArr;
    }

    /**
     * @param array $dayData
     * @return array
     * @throws \SyException\Cron\CronException
     */
    private static function analyseCronDay(array $dayData)
    {
        if (($dayData['num'] <= 0) || ($dayData['num'] > 32)) {
            throw new CronException('日期格式不合法', ErrorCode::CRON_DAY_ERROR);
        }

        $resArr = [];
        switch ($dayData['type']) {
            case self::DATA_TYPE_ALL:
                foreach (self::$totalDays as $eDay) {
                    if (($eDay % $dayData['num']) == 0) {
                        $resArr[] = $eDay;
                    }
                }
                break;
            case self::DATA_TYPE_SINGLE:
                $totalDays = self::checkDays($dayData['data']);
                if ($totalDays === false) {
                    throw new CronException('日期格式不合法', ErrorCode::CRON_DAY_ERROR);
                }

                foreach ($totalDays as $eDay) {
                    if (($eDay % $dayData['num']) == 0) {
                        $resArr[] = $eDay;
                    }
                }
                break;
            case self::DATA_TYPE_RANGE:
                foreach ($dayData['data'] as $eData) {
                    if ($eData['min'] < 0) {
                        throw new CronException('日期格式不合法', ErrorCode::CRON_DAY_ERROR);
                    } elseif ($eData['min'] >= 32) {
                        throw new CronException('日期格式不合法', ErrorCode::CRON_DAY_ERROR);
                    } elseif ($eData['max'] < 0) {
                        throw new CronException('日期格式不合法', ErrorCode::CRON_DAY_ERROR);
                    } elseif ($eData['max'] >= 32) {
                        throw new CronException('日期格式不合法', ErrorCode::CRON_DAY_ERROR);
                    } elseif ($eData['min'] > $eData['max']) {
                        throw new CronException('日期格式不合法', ErrorCode::CRON_DAY_ERROR);
                    }

                    for ($i = $eData['min']; $i <= $eData['max']; $i++) {
                        if (($i % $dayData['num']) == 0) {
                            $resArr[] = $i;
                        }
                    }
                }
                break;
            default:
                break;
        }

        if (empty($resArr)) {
            throw new CronException('日期格式不合法', ErrorCode::CRON_DAY_ERROR);
        }
        array_unique($resArr);

        return $resArr;
    }

    /**
     * @param array $monthData
     * @return array
     * @throws \SyException\Cron\CronException
     */
    private static function analyseCronMonth(array $monthData)
    {
        if (($monthData['num'] <= 0) || ($monthData['num'] > 12)) {
            throw new CronException('月份格式不合法', ErrorCode::CRON_MONTH_ERROR);
        }

        $resArr = [];
        switch ($monthData['type']) {
            case self::DATA_TYPE_ALL:
                foreach (self::$totalMonths as $eMonth) {
                    if (($eMonth % $monthData['num']) == 0) {
                        $resArr[] = $eMonth;
                    }
                }
                break;
            case self::DATA_TYPE_SINGLE:
                $totalMonths = self::checkMonths($monthData['data']);
                if ($totalMonths === false) {
                    throw new CronException('月份格式不合法', ErrorCode::CRON_MONTH_ERROR);
                }

                foreach (self::$totalMonths as $eMonth) {
                    if (($eMonth % $monthData['num']) == 0) {
                        $resArr[] = $eMonth;
                    }
                }
                break;
            case self::DATA_TYPE_RANGE:
                foreach ($monthData['data'] as $eData) {
                    if ($eData['min'] < 0) {
                        throw new CronException('月份格式不合法', ErrorCode::CRON_MONTH_ERROR);
                    } elseif ($eData['min'] >= 12) {
                        throw new CronException('月份格式不合法', ErrorCode::CRON_MONTH_ERROR);
                    } elseif ($eData['max'] < 0) {
                        throw new CronException('月份格式不合法', ErrorCode::CRON_MONTH_ERROR);
                    } elseif ($eData['max'] >= 12) {
                        throw new CronException('月份格式不合法', ErrorCode::CRON_MONTH_ERROR);
                    } elseif ($eData['min'] > $eData['max']) {
                        throw new CronException('月份格式不合法', ErrorCode::CRON_MONTH_ERROR);
                    }

                    for ($i = $eData['min']; $i <= $eData['max']; $i++) {
                        if (($i % $monthData['num']) == 0) {
                            $resArr[] = $i;
                        }
                    }
                }
                break;
            default:
                break;
        }

        if (empty($resArr)) {
            throw new CronException('月份格式不合法', ErrorCode::CRON_MONTH_ERROR);
        }
        array_unique($resArr);

        return $resArr;
    }

    /**
     * @param array $weekData
     * @return array
     * @throws \SyException\Cron\CronException
     */
    private static function analyseCronWeek(array $weekData)
    {
        if (($weekData['num'] <= 0) || ($weekData['num'] > 7)) {
            throw new CronException('星期格式不合法', ErrorCode::CRON_WEEK_ERROR);
        }

        $resArr = [];
        switch ($weekData['type']) {
            case self::DATA_TYPE_ALL:
                foreach (self::$totalWeeks as $eWeek) {
                    if (($eWeek % $weekData['num']) == 0) {
                        $resArr[] = $eWeek;
                    }
                }
                break;
            case self::DATA_TYPE_SINGLE:
                $totalWeeks = self::checkWeeks($weekData['data']);
                if ($totalWeeks === false) {
                    throw new CronException('星期格式不合法', ErrorCode::CRON_WEEK_ERROR);
                }

                foreach (self::$totalWeeks as $eWeek) {
                    if (($eWeek % $weekData['num']) == 0) {
                        $resArr[] = $eWeek;
                    }
                }
                break;
            case self::DATA_TYPE_RANGE:
                foreach ($weekData['data'] as $eData) {
                    if ($eData['min'] < 0) {
                        throw new CronException('星期格式不合法', ErrorCode::CRON_WEEK_ERROR);
                    } elseif ($eData['min'] >= 7) {
                        throw new CronException('星期格式不合法', ErrorCode::CRON_WEEK_ERROR);
                    } elseif ($eData['max'] < 0) {
                        throw new CronException('星期格式不合法', ErrorCode::CRON_WEEK_ERROR);
                    } elseif ($eData['max'] >= 7) {
                        throw new CronException('星期格式不合法', ErrorCode::CRON_WEEK_ERROR);
                    } elseif ($eData['min'] > $eData['max']) {
                        throw new CronException('星期格式不合法', ErrorCode::CRON_WEEK_ERROR);
                    }

                    for ($i = $eData['min']; $i <= $eData['max']; $i++) {
                        if (($i % $weekData['num']) == 0) {
                            $resArr[] = $i;
                        }
                    }
                }
                break;
            default:
                break;
        }

        if (empty($resArr)) {
            throw new CronException('星期格式不合法', ErrorCode::CRON_WEEK_ERROR);
        }
        array_unique($resArr);

        return $resArr;
    }
}
