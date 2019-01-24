<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/29 0029
 * Time: 17:36
 */
namespace IDE;

class DeclaredSeasLog extends BaseModuleGenerator {
    public function __construct() {
        parent::__construct('SeasLog');
    }

    private function __clone() {
    }

    protected function getModuleClasses() : array {
        $classes = array_merge(get_declared_classes(), get_declared_interfaces());
        foreach ($classes as $key => $value) {
            if (strncasecmp($value, 'SeasLog', 7) != 0) {
                unset($classes[$key]);
            }
        }

        return $classes;
    }
}