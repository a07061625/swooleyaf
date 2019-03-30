<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 19:28
 */
namespace QCloud;

abstract class CloudBaseCos extends CloudBase {
    public function __construct(){
        parent::__construct();
    }

    private function __clone(){
    }
}