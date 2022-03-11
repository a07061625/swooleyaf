<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 8:50
 */

namespace Wx;

abstract class WxBase
{
    /**
     * 服务地址
     *
     * @var string
     */
    protected $serviceUrl = '';
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
        //do nothing
    }

    /**
     * 设置CURL配置
     *
     * @param int   $optTag 配置标识
     * @param mixed $optVal 配置值
     */
    public function setCurlConfig(int $optTag, $optVal)
    {
        $this->curlConfigs[$optTag] = $optVal;
    }

    abstract public function getDetail(): array;
}
