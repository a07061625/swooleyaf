<?php
/**
 * 创建thing
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Thing;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class ThingCreate extends BaseBaiDu
{
    /**
     * endpoint名称
     *
     * @var string
     */
    private $endpointName = '';
    /**
     * thing名称
     *
     * @var string
     */
    private $thingName = '';

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
            $this->serviceUri = '/v1/endpoint/' . $endpointName . '/thing';
        } else {
            throw new BaiDuIotException('endpoint名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $thingName
     *
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

    public function getDetail() : array
    {
        if (strlen($this->endpointName) == 0) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['thingName'])) {
            throw new BaiDuIotException('thing名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

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
