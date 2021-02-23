<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class LogModuleEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 日志级别
     *
     * @var string
     */
    public $log_level = '';

    /**
     * 服务端ip
     *
     * @var string
     */
    public $server_ip = '';

    /**
     * 模块名称
     *
     * @var string
     */
    public $log_module = '';

    /**
     * 日志内容
     *
     * @var string
     */
    public $log_content = '';

    /**
     * 创建毫秒级时间戳
     *
     * @var float
     */
    public $created = 0.00;

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'log_module', 'id');
    }
}
