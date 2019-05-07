<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/10 0010
 * Time: 17:55
 */
namespace SyPrint;

abstract class PrintBase
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

    abstract public function getDetail() : array;
}
