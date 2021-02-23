<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class UserRoleEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 用户ID
     *
     * @var string
     */
    public $user_id = '';

    /**
     * 角色标识
     *
     * @var string
     */
    public $role_tag = '';

    /**
     * 修改时间戳
     *
     * @var int
     */
    public $created = 0;

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'user_role', 'id');
    }
}
