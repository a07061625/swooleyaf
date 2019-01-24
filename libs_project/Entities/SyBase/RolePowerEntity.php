<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class RolePowerEntity extends MysqlEntity {
    public function __construct(string $dbName='') {
        $this->_dbName = isset($dbName{0}) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'role_power', 'id');
    }

    /**
     * 
     * @var int
     */
    public $id = null;

    /**
     * 标识
     * @var string
     */
    public $tag = '';

    /**
     * 级别
     * @var int
     */
    public $level = 0;

    /**
     * 标题
     * @var string
     */
    public $title = '';

    /**
     * 图标
     * @var string
     */
    public $icon = '';

    /**
     * 路由路径
     * @var string
     */
    public $router_path = '';

    /**
     * 排序值,数字越大越在前
     * @var int
     */
    public $sort_num = 0;

    /**
     * 创建时间戳
     * @var int
     */
    public $created = 0;

    /**
     * 修改时间戳
     * @var int
     */
    public $updated = 0;
}
