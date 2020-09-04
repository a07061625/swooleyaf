<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 14:37
 */
namespace SyObjectStorage;

/**
 * Class Base
 * @package SyObjectStorage
 */
abstract class Base
{
    /**
     * 请求数据
     *
     * @var array
     */
    protected $reqData = [];
    /**
     * curl配置数组
     *
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
