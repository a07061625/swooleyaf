<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/28 0028
 * Time: 13:49
 */
namespace SyEventTask\Project;

use SyConstant\Project;
use SyConstant\SyInner;
use SyEventTask\TaskBase;

/**
 * Class Demo
 *
 * @package SyEventTask\Project
 */
class Demo extends TaskBase
{
    public function __construct()
    {
        parent::__construct();
        //设置在哪些模块中执行,如果要在所有模块都执行则无需任何设置,默认的空数组代表所有模块
        $this->supportModules[Project::MODULE_NAME_API] = 1;
        //设置在哪些服务端执行,如果所有服务端都执行则无需任何设置,默认的空数组代表所有服务端
        $this->supportServerTypes[SyInner::SERVER_TYPE_API_GATE] = 1;
        //间隔时间,单位为毫秒,取值范围为1000-86400000
        $this->intervalTime = 30000;
    }

    public function __clone()
    {
    }

    /**
     * 设置定时任务参数
     *
     * @return array
     */
    public function getData() : array
    {
        return [];
    }

    /**
     * 执行定时任务,参数数据和上面的方法保持相同
     *
     * @param array $data
     */
    public function handle(array $data)
    {
    }
}
