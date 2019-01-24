<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/7 0007
 * Time: 9:42
 */
namespace SySms;

abstract class SmsBase {
    /**
     * 请求数据
     * @var array
     */
    protected $reqData = [];

    public function __construct(){
    }

    private function __clone(){
    }

    abstract protected function getContent() : array;
    abstract public function getDetail() : array;
}