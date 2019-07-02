<?php
namespace Entities\SyTask;

use DB\Entities\MysqlEntity;

class WebhookEntity extends MysqlEntity
{
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
     * 代码地址
     * @var string
     */
    public $code_url = '';

    /**
     * 代码分支
     * @var string
     */
    public $code_ref = '';

    /**
     * 执行命令列表
     * @var string
     */
    public $exec_commands = '';

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

    public function __construct(string $dbName = '')
    {
        $this->_dbName = isset($dbName{0}) ? $dbName : 'sy_task';
        parent::__construct($this->_dbName, 'webhook', 'id');
    }
}
