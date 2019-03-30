<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/30 0030
 * Time: 19:28
 */
namespace QCloud;

abstract class CloudBase {
    /**
     * 请求数据
     * @var array
     */
    protected $reqData = [];
    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];

    public function __construct(){
    }

    private function __clone(){
    }
}