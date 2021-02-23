<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class TimedTaskEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id;

    /**
     * 任务类型
     *
     * @var int
     */
    public $type = 0;

    /**
     * 请求模块类型
     *
     * @var int
     */
    public $model_type = 0;

    /**
     * 请求uri
     *
     * @var string
     */
    public $uri = '';

    /**
     * 请求参数内容,json格式
     *
     * @var string
     */
    public $content = '';

    /**
     * 开始执行的时间戳
     *
     * @var int
     */
    public $handle_time = 0;

    /**
     * 处理标识
     *
     * @var string
     */
    public $handle_tag = '';

    /**
     * 状态
     *
     * @var int
     */
    public $status = 0;

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

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'timed_task', 'id');
    }
}
