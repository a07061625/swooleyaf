<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-22
 * Time: 下午10:45
 */
namespace SyModule;

use Constant\Project;

class SyModuleContent extends ModuleRpc {
    /**
     * @var \SyModule\SyModuleContent
     */
    private static $instance = null;

    private function __construct() {
        $this->moduleBase = Project::MODULE_BASE_CONTENT;
        $this->moduleName = Project::MODULE_NAME_CONTENT;
        parent::init();
    }

    /**
     * @return \SyModule\SyModuleContent
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}