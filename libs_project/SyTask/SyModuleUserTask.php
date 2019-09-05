<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/10
 * Time: 13:32
 */
namespace SyTask;

use SyConstant\Project;

class SyModuleUserTask extends SyModuleTaskBase implements SyModuleTaskInterface
{
    public function __construct()
    {
        parent::__construct();
        $this->moduleTag = Project::MODULE_NAME_USER;
    }

    private function __clone()
    {
    }

    public function handleTask(array $data)
    {
    }
}
