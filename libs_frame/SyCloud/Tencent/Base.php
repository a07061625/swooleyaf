<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/2 0002
 * Time: 10:39
 */
namespace SyCloud\Tencent;

use SyConstant\ErrorCode;
use SyException\Cloud\TencentException;
use SyTool\Tool;

/**
 * Class Base
 * @package SyCloud\Tencent
 */
abstract class Base extends \SyCloud\Base
{
    /**
     * 请求头
     * @var array
     */
    protected $reqHeader = [];
    /**
     * 服务名称
     * @var string
     */
    protected $serviceName = '';
    /**
     * 服务域名
     * @var string
     */
    protected $serviceDomain = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader = [
            'Content-Type' => 'application/json',
            'Expect' => '',
        ];
    }

    /**
     * @param string $serviceDomain
     * @throws \SyException\Cloud\TencentException
     */
    public function setServiceDomain(string $serviceDomain)
    {
        if (strlen($serviceDomain) > 0) {
            $this->serviceDomain = $serviceDomain;
            $this->reqHeader['Host'] = $serviceDomain;
        } else {
            throw new TencentException('重定向链接不合法', ErrorCode::CLOUD_TENCENT_ERROR);
        }
    }

    /**
     * 添加请求签名
     * @param string $secretId
     * @param string $secretKey
     * @param string $dataType
     */
    protected function addReqSign(string $secretId, string $secretKey, string $dataType = 'json')
    {
        if ($dataType == 'json') {
            $postData = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        } else {
            $postData = http_build_query($this->reqData);
        }
        $signRes = Util::createTC3Sign($secretId, $secretKey, [
            'req_headers' => $this->reqHeader,
            'req_data' => $postData,
            'service_name' => $this->serviceName,
        ]);
        $this->reqHeader['X-TC-Timestamp'] = $signRes['timestamp'];
        $this->reqHeader['Authorization'] = $signRes['authorization'];
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $postData;
    }

    protected function getContent() : array
    {
        $this->setBaseCurlConfigs();
        $this->curlConfigs[CURLOPT_URL] = 'https://' . $this->serviceDomain;
        $this->curlConfigs[CURLOPT_POST] = true;
        $reqHeaderArr = [];
        foreach ($this->reqHeader as $headerKey => $headerVal) {
            $reqHeaderArr[] = $headerKey . ': ' . $headerVal;
        }
        $this->curlConfigs[CURLOPT_HTTPHEADER] = $reqHeaderArr;
        if (!isset($this->curlConfigs[CURLOPT_TIMEOUT_MS])) {
            $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 2000;
        }

        return $this->curlConfigs;
    }
}
