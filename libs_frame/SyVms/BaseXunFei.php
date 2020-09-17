<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/17 0017
 * Time: 15:28
 */
namespace SyVms;

/**
 * Class BaseXunFei
 *
 * @package SyVms
 */
abstract class BaseXunFei extends Base
{
    /**
     * 服务地址
     *
     * @var string
     */
    protected $serviceUrl = '';
    /**
     * 请求方式
     *
     * @var string
     */
    protected $reqMethod = '';
    /**
     * 请求头参数
     *
     * @var array
     */
    protected $reqHeaders = [];

    public function __construct()
    {
        parent::__construct();
        $this->reqMethod = 'GET';
        $this->reqHeaders = [
            'Content-Type' => 'application/json;charset=UTF-8',
        ];
    }

    protected function getContent() : array
    {
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [];
        foreach ($this->reqHeaders as $key => $val) {
            $this->curlConfigs[CURLOPT_HTTPHEADER][] = $key . ': ' . $val;
        }
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 3000;
        }

        return $this->curlConfigs;
    }
}
