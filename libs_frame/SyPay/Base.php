<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:39
 */
namespace SyPay;

use SyConstant\ErrorCode;
use SyException\Pay\PayException;

/**
 * Class Base
 *
 * @package SyPay
 */
abstract class Base
{
    const ENV_TYPE_DEV = 'dev'; //环境类型-开发
    const ENV_TYPE_PRODUCT = 'product'; //环境类型-生产

    /**
     * curl配置
     *
     * @var array
     */
    protected $curlConfigs = [];
    /**
     * 请求数据
     *
     * @var array
     */
    protected $reqData = [];
    /**
     * 请求头
     *
     * @var array
     */
    protected $reqHeaders = [];
    /**
     * 请求域名列表
     *
     * @var array
     */
    protected $reqDomains = [];
    /**
     * 请求域名
     *
     * @var string
     */
    protected $reqDomain = '';

    /**
     * Base constructor.
     *
     * @param string $envType
     *
     * @throws \SyException\Pay\PayException
     */
    public function __construct(string $envType)
    {
        if (isset($this->reqDomains[$envType])) {
            $this->reqDomain = $this->reqDomains[$envType];
        } else {
            throw new PayException('环境类型不支持', ErrorCode::PAY_PARAM_ERROR);
        }
    }
    abstract public function getDetail() : array;

    abstract protected function getContent();
}
