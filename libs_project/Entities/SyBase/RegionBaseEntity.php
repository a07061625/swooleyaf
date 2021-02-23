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

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'region_base', 'tag');
    }
}
