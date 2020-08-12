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
 * @package SyPay
 */
abstract class Base
{
    const ENV_TYPE_DEV = 'dev'; //环境类型-开发
    const ENV_TYPE_PRODUCT = 'product'; //环境类型-生产

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
    protected $reqHeaders = [];
    /**
     * 环境类型
     * @var string
     */
    protected $envType = '';

    public function __construct()
    {
        $this->envType = self::ENV_TYPE_PRODUCT;
    }

    /**
     * @param string $envType
     * @throws \SyException\Pay\PayException
     */
    public function setEnvType(string $envType)
    {
        if (in_array($envType, [self::ENV_TYPE_DEV, self::ENV_TYPE_PRODUCT])) {
            $this->envType = $envType;
        } else {
            throw new PayException('环境类型不支持', ErrorCode::PAY_PARAM_ERROR);
        }
    }

    abstract public function getContent() : array;
    abstract public function getDetail() : array;
}
