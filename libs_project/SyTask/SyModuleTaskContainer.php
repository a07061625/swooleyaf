<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/12/11 0011
 * Time: 9:20
 */
namespace SyTask;

use SyConstant\Project;
use SyTool\BaseContainer;

class SyModuleTaskContainer extends BaseContainer
{
    public function __construct()
    {
        $this->registryMap = [
            Project::MODULE_NAME_API,
            Project::MODULE_NAME_ORDER,
            Project::MODULE_NAME_CONTENT,
            Project::MODULE_NAME_SERVICE,
            Project::MODULE_NAME_USER,
        ];

        $this->bind(Project::MODULE_NAME_API, function () {
            return new SyModuleApiTask();
        });
        $this->bind(Project::MODULE_NAME_ORDER, function () {
            return new SyModuleOrderTask();
        });
        $this->bind(Project::MODULE_NAME_CONTENT, function () {
            return new SyModuleContentTask();
        });
        $this->bind(Project::MODULE_NAME_SERVICE, function () {
            return new SyModuleServiceTask();
        });
        $this->bind(Project::MODULE_NAME_USER, function () {
            return new SyModuleUserTask();
        });
    }
}
