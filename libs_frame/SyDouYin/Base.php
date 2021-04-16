<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/14 0014
 * Time: 20:36
 */

namespace SyDouYin;

use SyConstant\ErrorCode;
use SyException\DouYin\DouYinException;

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
     * 服务域名类型
     *
     * @var string
     */
    protected $serviceHostType = '';
    /**
     * 服务域名状态 true:允许修改 false:不允许修改
     *
     * @var bool
     */
    protected $serviceHostStatus = true;

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
        if (0 == \strlen($this->serviceHost)) {
            $this->setServiceHost(Util::SERVICE_HOST_TYPE_DOUYIN);
        }
        $this->serviceHostStatus = false;
    }

    /**
     * 设置服务域名
     *
     * @param string $type 域名类型
     *
     * @throws \SyException\DouYin\DouYinException
     */
    public function setServiceHost(string $type)
    {
        if ($this->serviceHostStatus) {
            $host = Util::getServiceHost($type);
            if (\strlen($host) > 0) {
                $this->serviceHost = $host;
                $this->serviceHostType = $type;
            } else {
                throw new DouYinException('服务域名类型不支持', ErrorCode::DOUYIN_PARAM_ERROR);
            }
        }
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
