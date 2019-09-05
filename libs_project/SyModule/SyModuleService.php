<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-22
 * Time: 下午10:45
 */
namespace SyModule;

use SyConstant\Project;

class SyModuleService extends ModuleRpc
{
    /**
     * @var \SyModule\SyModuleService
     */
    private static $instance = null;

    private function __construct()
    {
        $this->moduleBase = Project::MODULE_BASE_SERVICE;
        $this->moduleName = Project::MODULE_NAME_SERVICE;
        parent::init();
    }

    /**
     * @return \SyModule\SyModuleService
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
