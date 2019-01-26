<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 8:57
 */
namespace DingDing;

abstract class TalkBase {
    /**
     * 服务域名
     * @var string
     */
    protected $serviceDomain = '';
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
        $this->serviceDomain = 'https://oapi.dingtalk.com';
    }

    abstract public function getDetail() : array;
}