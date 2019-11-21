<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/21 0021
 * Time: 18:00
 */
namespace QiNiu;

abstract class QiNiuBase
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
     * 请求头
     * @var array
     */
    protected $reqHeader = [];

    public function __construct()
    {
    }

    abstract public function getDetail() : array;
    abstract protected function getContent() : array;
}
