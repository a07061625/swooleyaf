<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class ImBaseEntity extends MysqlEntity
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
     * 用户类型 1:管理员 2:用户
     *
     * @var int
     */
    public $user_type = 0;

    /**
     * 即时通讯签名
     *
     * @var string
     */
    public $sign = '';

    /**
     * 签名过期时间戳
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
    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName[0]) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'im_base', 'id');
    }
}
