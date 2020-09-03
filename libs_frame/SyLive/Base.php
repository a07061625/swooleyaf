<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/27 0027
 * Time: 19:04
 */
namespace SyLive;

/**
 * Class Base
 * @package SyLive
 */
abstract class Base
{
    /**
     * curl配置
     * @var array
     */
    protected $curlConfigs = [];
    /**
     * 请求数据
     * @var array
     */
    protected $reqData = [];

    public function __construct()
    {
    }

    /**
     * @return array
     */
    public function getCurlConfigs() : array
    {
        return $this->curlConfigs;
    }

    abstract public function getDetail() : array;
    abstract protected function getContent() : array;
}
