<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class RolePermissionEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 角色标识
     *
     * @var string
     */
    public $role_tag = '';

    /**
     * 权限标识
     *
     * @var string
     */
    public $permission_tag = '';

    /**
     * 修改时间戳
     *
     * @var int
     */
    public $created = 0;

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'role_permission', 'id');
    }
}
