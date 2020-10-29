<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class PermissionBaseEntity extends MysqlEntity
{
    /**
     *
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
     * 节点类型
     *
     * @var int
     */
    public $node_type = 0;

    /**
     * 级别
     *
     * @var int
     */
    public $level_num = 0;

    /**
     * 标题
     *
     * @var string
     */
    public $title = '';

    /**
     * 图标地址
     *
     * @var string
     */
    public $path_icon = '';

    /**
     * 重定向地址
     *
     * @var string
     */
    public $path_redirect = '';

    /**
     * 排序值,数字越大越在前
     *
     * @var int
     */
    public $sort_num = 0;

    /**
     * 扩展数据,json格式
     *
     * @var string
     */
    public $extend_data = '';

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
        parent::__construct($this->_dbName, 'permission_base', 'id');
    }
}
