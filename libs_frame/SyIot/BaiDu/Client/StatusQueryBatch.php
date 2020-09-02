<?php
/**
 * 获取所有MQTT客户端在线状态
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 11:57
 */
namespace SyIot\BaiDu\Client;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class StatusQueryBatch extends BaseBaiDu
{
    /**
     * endpoint名称
     *
     * @var string
     */
    private $endpointName = '';
    /**
     * 客户端ID列表
     *
     * @var array
     */
    private $mqttID = [];

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
            $this->serviceUri = '/v2/endpoint/' . $endpointName . '/batch-client-query/status';
        } else {
            throw new BaiDuIotException('endpoint名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function setClientIdList(array $clientIdList)
    {
        if (empty($clientIdList)) {
            throw new BaiDuIotException('客户端ID列表不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        foreach ($clientIdList as $eClientId) {
            if (is_string($eClientId) && (strlen($eClientId) > 0)) {
                $this->mqttID[$eClientId] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->endpointName) == 0) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (empty($this->mqttID)) {
            throw new BaiDuIotException('客户端ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->reqData['mqttID'] = array_keys($this->mqttID);

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_POST,
            'req_uri' => $this->serviceUri,
            'req_params' => [],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
