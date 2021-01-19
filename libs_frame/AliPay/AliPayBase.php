<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 13:59
 */

namespace AliPay;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\AliPay\AliPayPayException;
use SyTool\Tool;

abstract class AliPayBase
{
    /**
     * 业务请求参数的集合
     *
     * @var array
     */
    protected $biz_content = [];
    /**
     * 主动通知地址
     *
     * @var string
     */
    protected $notify_url = '';
    /**
     * 同步通知地址
     *
     * @var string
     */
    protected $return_url = '';

    /**
     * 跳转基础url地址
     *
     * @var string
     */
    protected $return_baseurl = '';
    /**
     * 支付宝分配给开发者的应用ID
     *
     * @var string
     */
    private $app_id = '';
    /**
     * 数据格式
     *
     * @var string
     */
    private $format = '';
    /**
     * 请求使用的编码格式
     *
     * @var string
     */
    private $charset = '';
    /**
     * 商户生成签名字符串所使用的签名算法类型，目前支持RSA2和RSA，推荐使用RSA2
     *
     * @var string
     */
    private $sign_type = '';
    /**
     * 发送请求的时间，格式"yyyy-MM-dd HH:mm:ss"
     *
     * @var string
     */
    private $timestamp = '';
    /**
     * 调用的接口版本，固定为：1.0
     *
     * @var string
     */
    private $version = '';
    /**
     * 接口名称
     *
     * @var string
     */
    private $method = '';
    /**
     * 响应标识
     *
     * @var string
     */
    private $response_tag = '';

    public function __construct(string $appId)
    {
        $this->app_id = $appId;
        $this->format = 'json';
        $this->charset = 'utf-8';
        $this->sign_type = 'RSA2';
        $this->timestamp = date('Y-m-d H:i:s');
        $this->version = '1.0';
    }

    private function __clone()
    {
    }

    public function getAppId(): string
    {
        return $this->app_id;
    }

    public function getResponseTag(): string
    {
        return $this->response_tag;
    }

    /**
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setReturnUrl(string $returnUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $returnUrl) > 0) {
            $this->return_url = $this->return_baseurl . urlencode($returnUrl);
        } else {
            throw new AliPayPayException('同步通知地址不合法', ErrorCode::ALIPAY_PARAM_ERROR);
        }
    }

    /**
     * 获取详情信息
     */
    abstract public function getDetail(): array;

    protected function setMethod(string $method)
    {
        $this->method = $method;
        $this->response_tag = str_replace('.', '_', $method) . '_response';
    }

    protected function getContent(): array
    {
        $content = [
            'app_id' => $this->app_id,
            'method' => $this->method,
            'format' => $this->format,
            'charset' => $this->charset,
            'sign_type' => $this->sign_type,
            'timestamp' => $this->timestamp,
            'version' => $this->version,
            'biz_content' => Tool::jsonEncode($this->biz_content, JSON_UNESCAPED_UNICODE),
        ];
        if (\strlen($this->notify_url) > 0) {
            $content['notify_url'] = $this->notify_url;
        }
        if (\strlen($this->return_url) > 0) {
            $content['return_url'] = $this->return_url;
        }
        $content['sign'] = AliPayUtilBase::createSign($content, $this->sign_type);

        return $content;
    }
}
