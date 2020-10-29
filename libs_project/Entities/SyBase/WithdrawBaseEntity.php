<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class WithdrawBaseEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 提现单号
     *
     * @var string
     */
    public $sn = '';

    /**
     * 提现方式 1:企业付款 2:银行卡 3:支付宝转账
     *
     * @var int
     */
    public $way = 0;

    /**
     * 用户ID
     *
     * @var string
     */
    public $uid = '';

    /**
     * 系统提成比例,单位为%
     *
     * @var double
     */
    public $total_commission = 2;

    /**
     * 提现金额,单位为分
     *
     * @var int
     */
    public $money = 0;

    /**
     * 用户提现到帐金额,单位为分
     *
     * @var int
     */
    public $user_money = 0;

    /**
     * 平台到帐金额,单位为分
     *
     * @var int
     */
    public $system_money = 0;

    /**
     * 提现方式名称,如果是银行卡则填写银行名称
     *
     * @var string
     */
    public $way_name = '';

    /**
     * 提现方式账号
     *
     * @var string
     */
    public $way_account = '';

    /**
     * 提现到帐账户名称
     *
     * @var string
     */
    public $account_name = '';

    /**
     * 二维码图片
     *
     * @var string
     */
    public $qrcode = '';

    /**
     * 用户资金信息JSON
     *
     * @var string
     */
    public $money_info = '';

    /**
     * 应用ID,微信企业付款为公众号ID,银行转账为空,支付宝转账为支付宝应用ID
     *
     * @var string
     */
    public $app_id = '';

    /**
     * 状态
     *
     * @var int
     */
    public $status = 0;

    /**
     * 备注信息
     *
     * @var string
     */
    public $remark = '';

    /**
     * 创建时间戳
     *
     * @var int
     */
    public $created = 0;

    /**
     * 修改时间戳
     *
     * @var int
     */
    public $updated = 0;
    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName[0]) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'withdraw_base', 'id');
    }
}
