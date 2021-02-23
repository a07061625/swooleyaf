<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class RefundHistoryEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 退款单号
     *
     * @var string
     */
    public $refund_sn = '';

    /**
     * 用户ID
     *
     * @var string
     */
    public $uid = '';

    /**
     * 操作类型
     *
     * @var int
     */
    public $option_type = 0;

    /**
     * 操作标题
     *
     * @var string
     */
    public $option_title = '';

    /**
     * 操作内容,json字符串
     *
     * @var string
     */
    public $option_content = '';

    /**
     * 创建时间戳
     *
     * @var int
     */
    public $created = 0;

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'refund_history', 'id');
    }
}
