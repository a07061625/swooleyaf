<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class UserMoneyHistoryEntity extends MysqlEntity
{
    /**
     * 主键ID
     *
     * @var int
     */
    public $id;

    /**
     * 数据类型
     *
     * @var int
     */
    public $data_type = 0;

    /**
     * 数据对应ID
     *
     * @var string
     */
    public $data_id = '';

    /**
     * 数据名称
     *
     * @var string
     */
    public $data_name = '';

    /**
     * 数据单号
     *
     * @var string
     */
    public $data_sn = '';

    /**
     * 总金额，单位为分，入账为正数，出账为负数
     *
     * @var int
     */
    public $total_money = 0;

    /**
     * 用户ID
     *
     * @var string
     */
    public $user_id = '';

    /**
     * 用户收入金额，单位为分
     *
     * @var int
     */
    public $user_in_money = 0;

    /**
     * 用户当前总金额，单位为分
     *
     * @var int
     */
    public $user_now_money = 0;

    /**
     * 检查金额,单位为分
     *
     * @var int
     */
    public $check_money = 0;

    /**
     * 扩展信息,json格式
     *
     * @var string
     */
    public $extend_info = '';

    /**
     * 备注
     *
     * @var string
     */
    public $remark = '';

    /**
     * 创建时间
     *
     * @var int
     */
    public $created = 0;

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'user_money_history', 'id');
    }
}
