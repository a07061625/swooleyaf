<?php
/**
 * 获取带TSDB格式的规则详情
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Rules;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\IotBaseBaiDu;
use SyIot\IotUtilBaiDu;

class RuleTSDBInfo extends IotBaseBaiDu
{
    /**
     * 设备名称
     * @var string
     */
    private $deviceName = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $deviceName
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setDeviceName(string $deviceName)
    {
        if (ctype_alnum($deviceName)) {
            $this->deviceName = $deviceName;
            $this->serviceUri = '/v3/iot/rules/device/' . $deviceName . '/format';
        } else {
            throw new BaiDuIotException('设备名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->deviceName) == 0) {
            throw new BaiDuIotException('设备名称不能为空', ErrorCode::IOT_PARAM_ERROR);
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
