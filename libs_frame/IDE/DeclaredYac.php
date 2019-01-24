<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/7/1 0001
 * Time: 11:37
 */
namespace IDE;

class DeclaredYac extends BaseModuleGenerator {
    public function __construct() {
        parent::__construct('yac');
    }

    private function __clone() {
    }

    protected function getModuleClasses() : array {
        $classes = array_merge(get_declared_classes(), get_declared_interfaces());
        foreach ($classes as $key => $value) {
            if(strncasecmp($value, 'Yac', 3) != 0){
                unset($classes[$key]);
            } else if(strncasecmp($value, 'Yaconf', 6) == 0){
                unset($classes[$key]);
            }
        }

        return $classes;
    }
}