<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 12:50
 */
namespace DingDing;

abstract class DingBase {
    /**
     * 服务地址
     * @var string
     */
    protected $serviceUrl = '';
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

    public function __construct(){
    }

    abstract public function getDetail() : array;
}