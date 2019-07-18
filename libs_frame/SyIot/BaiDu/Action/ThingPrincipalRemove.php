<?php
/**
 * 从一个Thing移除一个Principal
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Action;

use Constant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\IotBaseBaiDu;
use SyIot\IotUtilBaiDu;
use Tool\Tool;

class ThingPrincipalRemove extends IotBaseBaiDu
{
    /**
     * endpoint名称
     * @var string
     */
    private $endpointName = '';
    /**
     * thing名称
     * @var string
     */
    private $thingName = '';
    /**
     * principal名称
     * @var string
     */
    private $principalName = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v1/action/remove-thing-principal';
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
            $this->reqData['endpointName'] = $endpointName;
        } else {
            throw new BaiDuIotException('endpoint名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $thingName
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setThingName(string $thingName)
    {
        if (ctype_alnum($thingName)) {
            $this->reqData['thingName'] = $thingName;
        } else {
            throw new BaiDuIotException('thing名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $principalName
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPrincipalName(string $principalName)
    {
        if (ctype_alnum($principalName)) {
            $this->reqData['principalName'] = $principalName;
        } else {
            throw new BaiDuIotException('principal名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['endpointName'])) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['thingName'])) {
            throw new BaiDuIotException('thing名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['principalName'])) {
            throw new BaiDuIotException('principal名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = IotUtilBaiDu::createSign([
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
