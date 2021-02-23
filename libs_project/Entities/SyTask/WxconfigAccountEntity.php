<?php

namespace Entities\SyTask;

use DB\Entities\MysqlEntity;

class WxconfigAccountEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 微信公众号ID
     *
     * @var string
     */
    public $app_id = '';

    /**
     * 用户ID
     *
     * @var string
     */
    public $user_id = '';

    /**
     * 状态
     *
     * @var int
     */
    public $status = 0;

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

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'wxconfig_account', 'id');
    }
}
