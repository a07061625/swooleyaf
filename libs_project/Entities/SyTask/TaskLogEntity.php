<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-5
 * Time: 15:30
 */
namespace Entities\SyTask;

use DB\Entities\MysqlEntity;

class TaskLogEntity extends MysqlEntity
{
    /**
     * 主键ID
     *
     * @var int
     */
    public $id;

    /**
     * 任务标识
     *
     * @var string
     */
    public $tag = '';

    /**
     * 任务结果,json格式
     *
     * @var string
     */
    public $exec_result = '';

    /**
     * 创建时间戳
     *
     * @var int
     */
    public $created = 0;
    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'task_log');
    }
}
