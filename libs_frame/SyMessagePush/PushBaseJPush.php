<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 11:03
 */
namespace SyMessagePush;

use Tool\Tool;

abstract class PushBaseJPush extends PushBase
{
    const REQ_METHOD_GET = 'GET';
    const REQ_METHOD_POST = 'POST';
    const REQ_METHOD_PUT = 'PUT';
    const REQ_METHOD_DELETE = 'DELETE';

    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];
    /**
     * 请求方式
     * @var string
     */
    protected $reqMethod = '';
    /**
     * 服务域名
     * @var string
     */
    protected $serviceDomain = '';
    /**
     * 服务uri
     * @var string
     */
    protected $serviceUri = '';
    /**
     * 标识
     * @var string
     */
    protected $objKey = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['Content-Type'] = 'application/json';
    }

    protected function getContent() : array
    {
        $url = $this->serviceDomain . $this->serviceUri;
        if ($this->reqMethod == self::REQ_METHOD_GET) {
            if (!empty($this->reqData)) {
                $url .= '?' . http_build_query($this->reqData);
            }
        } elseif ($this->reqMethod == self::REQ_METHOD_DELETE) {
            $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = 'DELETE';
            if (!empty($this->reqData)) {
                $url .= '?' . http_build_query($this->reqData);
            }
        } elseif ($this->reqMethod == self::REQ_METHOD_POST) {
            $this->curlConfigs[CURLOPT_POST] = true;
            $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        } elseif ($this->reqMethod == self::REQ_METHOD_PUT) {
            $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
            $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = 'PUT';
        }
        $this->curlConfigs[CURLOPT_URL] = $url;
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_HEADER] = false;
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        }
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [];
        foreach ($this->reqHeader as $key => $val) {
            $this->curlConfigs[CURLOPT_HTTPHEADER][] = $key . ':' . $val;
        }
        return $this->curlConfigs;
    }
}
