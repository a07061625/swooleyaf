<?php
/**
 * 获取指定的endpoint信息
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Endpoint;

use Constant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\IotBaseBaiDu;
use SyIot\IotUtilBaiDu;

class EndpointInfo extends IotBaseBaiDu
{
    /**
     * endpoint名称
     * @var string
     */
    private $endpointName = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $endpointName
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setEndpointName(string $endpointName)
    {
        if (ctype_alnum($endpointName)) {
            $this->endpointName = $endpointName;
            $this->serviceUri = '/v1/endpoint/' . $endpointName;
        } else {
            throw new BaiDuIotException('endpoint名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->endpointName) == 0) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = IotUtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_GET,
            'req_uri' => $this->serviceUri,
            'req_params' => [],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri;
        return $this->getContent();
    }
}
