<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/11 0011
 * Time: 13:13
 */
namespace SyTaoBao;

abstract class ServiceBase
{
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
    /**
     * 应用标识
     * @var string
     */
    protected $appKey = '';
    /**
     * 应用密钥
     * @var string
     */
    protected $appSecret = '';
    /**
     * 响应标识
     * @var string
     */
    private $responseTag = '';

    public function __construct()
    {
        $this->reqData['v'] = '2.0';
        $this->reqData['sign_method'] = 'md5';
        $this->reqData['format'] = 'json';
        $this->reqData['simplify'] = true;
        $this->reqData['timestamp'] = date('Y-m-d H:i:s');
        $this->curlConfigs[CURLOPT_URL] = SY_TAOBAO_ENV;
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getResponseTag() : string
    {
        return $this->responseTag;
    }

    /**
     * @param string $method
     */
    protected function setMethod(string $method)
    {
        $this->reqData['method'] = $method;
        $methodArr = explode('.', $method);
        if ($methodArr[0] == 'taobao') {
            unset($methodArr[0]);
        }
        $this->responseTag = implode('_', $methodArr) . '_response';
    }

    protected function getContent()
    {
        $this->reqData['app_key'] = $this->appKey;
        UtilBase::createSign($this->reqData, $this->appSecret, $this->reqData['sign_method']);
        $this->curlConfigs[CURLOPT_NOSIGNAL] = true;
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = http_build_query($this->reqData);
        $this->curlConfigs[CURLOPT_RETURNTRANSFER] = true;
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Expect:',
        ];
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        }
        return $this->curlConfigs;
    }

    abstract public function getDetail() : array;
}
