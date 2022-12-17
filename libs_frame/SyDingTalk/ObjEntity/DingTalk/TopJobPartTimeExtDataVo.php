<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 兼职字段
 *
 * @author auto create
 */
class TopJobPartTimeExtDataVo
{
    /**
     * 兼职联系方式
     */
    public $contact_number;

    /**
     * 薪资计算周期 HOUR:按小时，DAY:按天，WEEK:按周，MONTH:按月，BY_TIME:按次
     */
    public $salary_period;

    /**
     * 薪资结算周期 DAY:日结，WEEK:周结，MONTH:月结，ONE_TIME:一次性结清，OTHER:其他
     */
    public $settle_type;

    /**
     * 是否指定工作日期，如果指定，则填充work_start_date，work_end_date
     */
    public $specify_work_date;

    /**
     * 是否指定工作时间，如果指定，则填充work_begin_time_min, work_end_time_min
     */
    public $specify_work_time;

    /**
     * 工作开始时间，单位分钟，从0点0分开始,如8:30为510
     */
    public $work_begin_time_min;

    /**
     * 工作日期类型 WORKDAY:工作日，WEEKEND:周末，HOLIDAY:节假日，NOT_WORKDAY:非工作日，包括周末和假期,OTHER:其他
     */
    public $work_date_type;

    /**
     * 工作结束日期
     */
    public $work_end_date;

    /**
     * 工作结束时间，单位分钟，从0点0分，如10:00值为600
     */
    public $work_end_time_min;

    /**
     * 工作开始日期
     */
    public $work_start_date;
}
