<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午1:05
 */
namespace SyMessagePush;

abstract class PushBase
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
