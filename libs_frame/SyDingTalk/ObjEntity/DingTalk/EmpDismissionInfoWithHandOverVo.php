<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 确认离职对象
 *
 * @author auto create
 */
class EmpDismissionInfoWithHandOverVo
{
    /**
     * 离职描述
     */
    public $dismission_memo;

    /**
     * 离职原因（1：家庭原因，2:个人原因，3：发展原因，4：合同到期不续签，5：协议解除，6：无法胜任工作，7：经济性裁员，8：严重违法违纪，9：其他）
     */
    public $dismission_reason;

    /**
     * 离职人userid
     */
    public $dismission_userid;

    /**
     * 交接人userid
     */
    public $hand_over_userid;

    /**
     * 最后工作日
     */
    public $last_work_date;
}
