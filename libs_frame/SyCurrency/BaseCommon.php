<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:21
 */
namespace SyCurrency;

abstract class BaseCommon
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
