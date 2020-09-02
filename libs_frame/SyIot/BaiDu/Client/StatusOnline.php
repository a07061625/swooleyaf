<?php
/**
 * 获取指定MQTT客户端在线状态
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 11:57
 */
namespace SyIot\BaiDu\Client;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;

class StatusOnline extends BaseBaiDu
{
    /**
     * endpoint名称
     *
     * @var string
     */
    private $endpointName = '';
    /**
     * 客户端ID
     *
     * @var string
     */
    private $clientId = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $endpointName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setEndpointName(string $endpointName)
    {
        if (ctype_alnum($endpointName)) {
            $this->endpointName = $endpointName;
        } else {
            throw new BaiDuIotException('endpoint名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $clientId
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setClientId(string $clientId)
    {
        if (strlen($clientId) > 0) {
            $this->clientId = $clientId;
        } else {
            throw new BaiDuIotException('客户端ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->endpointName) == 0) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (strlen($this->clientId) == 0) {
            throw new BaiDuIotException('客户端ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->serviceUri = '/v2/endpoint/' . $this->endpointName . '/client/' . $this->clientId . '/status/online';

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
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
