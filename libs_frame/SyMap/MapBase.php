<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午1:05
 */
namespace SyMap;

abstract class MapBase
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
    /**
     * 响应数据键名
     * @var string
     */
    protected $rspDataKey = '';

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

    /**
     * @return string
     */
    public function getRspDataKey() : string
    {
        return $this->rspDataKey;
    }
    abstract public function getDetail() : array;

    abstract protected function getContent() : array;
}
