<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/28 0028
 * Time: 8:45
 */
namespace SyEventTask;

/**
 * Class TaskBase
 *
 * @package SyEventTask
 */
abstract class TaskBase
{
    /**
     * 支持的模块列表,空数组为支持所有模块,模块常量以\SyConstant\Project::MODULE_NAME_开头的常量为准
     *
     * @var array
     */
    protected $supportModules = [];
    /**
     * 支持的服务类型,空数组为支持所有类型服务,服务类型常量以\SyConstant\SyInner::SERVER_TYPE_开头的常量为准
     *
     * @var array
     */
    protected $supportServerTypes = [];
    /**
     * 间隔时间,单位为毫秒,取值范围: 1000-86400000
     *
     * @var int
     */
    protected $intervalTime = 0;

    public function __construct()
    {
        $this->supportModules = [];
        $this->supportServerTypes = [];
        $this->intervalTime = 1000;
    }

    /**
     * 获取任务参数
     *
     * @return array
     */
    abstract public function getData() : array;

    /**
     * 执行任务
     *
     * @param array $data
     *
     * @return mixed
     */
    abstract public function handle(array $data);

    /**
     * @return array
     */
    public function getSupportModules() : array
    {
        return $this->supportModules;
    }

    /**
     * @return array
     */
    public function getSupportServerTypes() : array
    {
        return $this->supportServerTypes;
    }

    /**
     * @return int
     */
    public function getIntervalTime() : int
    {
        return $this->intervalTime;
    }
}
