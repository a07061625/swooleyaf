<?php
/**
 * 删除设备
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Management\Device;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class DeviceDelete extends BaseBaiDu
{
    /**
     * 设备名称列表
     *
     * @var array
     */
    private $devices = [];

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v3/iot/management/device';
    }

    private function __clone()
    {
    }

    /**
     * @param array $devices
     */
    public function setDevices(array $devices)
    {
        foreach ($devices as $eDeviceName) {
            if (ctype_alnum($eDeviceName)) {
                $this->devices[$eDeviceName] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (empty($this->devices)) {
            throw new BaiDuIotException('设备名称列表不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_PUT,
            'req_uri' => $this->serviceUri,
            'req_params' => [
                'remove' => ''
            ],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri . '?remove';
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = self::REQ_METHOD_PUT;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
