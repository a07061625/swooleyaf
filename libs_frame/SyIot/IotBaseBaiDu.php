<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 14:09
 */
namespace SyIot;

abstract class IotBaseBaiDu extends IotBase
{
    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];
    /**
     * 服务uri
     * @var string
     */
    protected $serviceUri = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    protected function getContent() : array
    {
        return $this->curlConfigs;
    }
}
