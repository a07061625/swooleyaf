<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:55
 */
namespace SyCloud;

/**
 * Class Base
 *
 * @package SyCloud
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

    protected function setBaseCurlConfigs()
    {
        $this->curlConfigs[CURLOPT_NOSIGNAL] = true;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
    }
    abstract protected function getContent() : array;
}
