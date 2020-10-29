<?php
namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class LogModuleEntity extends MysqlEntity
{
    /**
     *
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
     * @var double
     */
    public $created = 0.00;
    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName[0]) ? $dbName : 'sy_base';
        parent::__construct($this->_dbName, 'log_module', 'id');
    }
}
