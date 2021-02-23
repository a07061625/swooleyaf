<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class RoleBaseEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 标识
     *
     * @var string
     */
    public $tag = '';

    /**
     * 角色名称
     *
     * @var string
     */
    public $title = '';

    /**
     * 状态
     *
     * @var int
     */
    public $status = 1;

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
        parent::__construct($trueTag, 'role_base', 'id');
    }
}
