<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:36
 */
namespace SyDouYin;

/**
 * Class Base
 * @package SyDouYin
 */
abstract class Base
{
    /**
     * 服务域名
     * @var string
     */
    protected $serviceHost = '';

    /**
     * 服务URI
     * @var string
     */
    protected $serviceUri = '';

    /**
     * 请求数据
     * @var array
     */
    protected $reqData = [];

    /**
     * curl配置
     * @var array
     */
    protected $curlConfigs = [];

    public function __construct()
    {
    }

    /**
     * 获取服务地址
     * @return string 服务地址
     */
    protected function getServiceUrl() : string
    {
        return $this->serviceHost . $this->serviceUri;
    }

    abstract public function getDetail() : array;

    abstract protected function getContent() : array;
}
