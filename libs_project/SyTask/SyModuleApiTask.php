<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/10
 * Time: 13:32
 */
namespace SyTask;

use MessageQueue\Consumer\Redis\AddJsLogService;
use MessageQueue\Consumer\Redis\AddMysqlLogService;
use SyConstant\Project;

class SyModuleApiTask extends SyModuleTaskBase implements SyModuleTaskInterface
{
    public function __construct()
    {
        parent::__construct();
        $this->moduleTag = Project::MODULE_NAME_API;
    }

    private function __clone()
    {
    }

    public function handleTask(array $data)
    {
//        //添加mysql日志任务
//        $mysqlLogService = new AddMysqlLogService();
//        $mysqlLogService->handleMessage([]);
//
//        //添加js日志任务
//        $jsLogService = new AddJsLogService();
//        $jsLogService->handleMessage([]);
    }
}
