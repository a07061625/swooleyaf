<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:36
 */

namespace SyDouYin;

/**
 * Class Base
 *
 * @package SyDouYin
 */
abstract class Base
{
    /**
     * 应用标识
     *
     * @var string
     */
    protected $clientKey = '';

    /**
     * 服务域名
     *
     * @var string
     */
    protected $serviceHost = '';

    /**
     * 服务URI
     *
     * @var string
     */
    protected $serviceUri = '';

    /**
     * 请求数据
     *
     * @var array
     */
    protected $reqData = [];

    /**
     * curl配置
     *
     * @var array
     */
    protected $curlConfigs = [];

    public function __construct(string $clientKey)
    {
        $this->clientKey = $clientKey;
    }

    abstract public function getDetail(): array;

    protected function getContent()
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceHost . $this->serviceUri;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        }
    }
}
