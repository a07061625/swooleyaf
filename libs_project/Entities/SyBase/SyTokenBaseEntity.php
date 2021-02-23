<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class SyTokenBaseEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 令牌标识
     *
     * @var string
     */
    public $tag = '';

    /**
     * 标题
     *
     * @var string
     */
    public $title = '';

    /**
     * 备注
     *
     * @var string
     */
    public $remark = '';

    /**
     * 到期时间
     *
     * @var int
     */
    public $expire_time = 0;

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
        parent::__construct($trueTag, 'sy_token_base', 'id');
    }
}
