<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class UserRoleEntity extends MysqlEntity
{
    /**
     *
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
    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName[0]) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'user_role', 'id');
    }
}
