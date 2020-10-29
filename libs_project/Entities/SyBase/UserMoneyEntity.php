<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class UserMoneyEntity extends MysqlEntity
{
    /**
     * 用户ID
     *
     * @var string
     */
    public $uid;

    /**
     * 线上交易总金额,单位为分
     *
     * @var int
     */
    public $money_online = 0;

    /**
     * 线下交易总金额,单位为分
     *
     * @var int
     */
    public $money_offline = 0;

    /**
     * 累计收入金额,单位为分
     *
     * @var int
     */
    public $money_income = 0;

    /**
     * 可提现金额,单位为分
     *
     * @var int
     */
    public $money_withdraw = 0;

    /**
     * 累计提现金额,单位为分
     *
     * @var int
     */
    public $money_withdrawed = 0;

    /**
     * 正在提现中的金额,单位分
     *
     * @var int
     */
    public $money_withdrawing = 0;

    /**
     * 累计到账金额,单位为分
     *
     * @var int
     */
    public $money_transfer = 0;

    /**
     * 冻结金额,单位为分
     *
     * @var int
     */
    public $money_freeze = 0;
    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName[0]) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'user_money', 'uid');
    }
}
