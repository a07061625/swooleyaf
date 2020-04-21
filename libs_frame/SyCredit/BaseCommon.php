<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/4/21 0021
 * Time: 14:01
 */
namespace SyCredit;

/**
 * Class BaseCommon
 * @package SyCredit
 */
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
