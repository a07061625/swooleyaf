<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/5 0005
 * Time: 9:34
 */
namespace SyModule;

use Constant\Project;
use Tool\BaseContainer;

class ModuleContainer extends BaseContainer {
    public function __construct(){
        $this->registryMap = [
            Project::MODULE_NAME_API,
        ];

        $this->bind(Project::MODULE_NAME_API, function () {
            return SyModuleApi::getInstance();
        });
    }
}