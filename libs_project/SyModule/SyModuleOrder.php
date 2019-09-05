<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-22
 * Time: 下午10:45
 */
namespace SyModule;

use SyConstant\Project;

class SyModuleOrder extends ModuleRpc
{
    /**
     * @var \SyModule\SyModuleOrder
     */
    private static $instance = null;

    private function __construct()
    {
        $this->moduleBase = Project::MODULE_BASE_ORDER;
        $this->moduleName = Project::MODULE_NAME_ORDER;
        parent::init();
    }

    /**
     * @return \SyModule\SyModuleOrder
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
