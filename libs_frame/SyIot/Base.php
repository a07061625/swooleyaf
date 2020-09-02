<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 14:09
 */
namespace SyIot;

abstract class Base
{
    /**
     * 请求数据
     * @var array
     */
    protected $reqData = [];
    /**
     * curl配置数组
     * @var array
     */
    protected $curlConfigs = [];

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    abstract public function getDetail() : array;
    abstract protected function getContent() : array;
}
