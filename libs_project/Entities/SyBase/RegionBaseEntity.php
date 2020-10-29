<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class RegionBaseEntity extends MysqlEntity
{
    /**
     * 标识
     *
     * @var string
     */
    public $tag;

    /**
     * 级别
     *
     * @var int
     */
    public $level = 0;

    /**
     * 名称
     *
     * @var string
     */
    public $title = '';

    /**
     * 排序
     *
     * @var int
     */
    public $sort = 0;
    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName[0]) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'region_base', 'tag');
    }
}
