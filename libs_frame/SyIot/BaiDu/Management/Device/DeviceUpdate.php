<?php
/**
 * 修改设备属性
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

class DeviceUpdate extends BaseBaiDu
{
    /**
     * 设备名称
     *
     * @var string
     */
    private $deviceName = '';
    /**
     * 属性列表
     *
     * @var array
     */
    private $attributes = [];
    /**
     * 设备属性
     *
     * @var array
     */
    private $device = [];

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $deviceName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setDeviceName(string $deviceName)
    {
        if (ctype_alnum($deviceName)) {
            $this->deviceName = $deviceName;
            $this->serviceUri = '/v3/iot/management/device/' . $deviceName;
        } else {
            throw new BaiDuIotException('设备名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @param array $device
     */
    public function setDevice(array $device)
    {
        $this->device = $device;
    }

    public function getDetail() : array
    {
        if (strlen($this->deviceName) > 0) {
            throw new BaiDuIotException('设备名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (empty($this->attributes) && empty($this->device)) {
            throw new BaiDuIotException('设备属性和属性列表不能都为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!empty($this->attributes)) {
            $this->reqData['attributes'] = $this->attributes;
        }
        if (!empty($this->device)) {
            $this->reqData['device'] = $this->device;
        }

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_PUT,
            'req_uri' => $this->serviceUri,
            'req_params' => [
                'updateProfile' => '',
            ],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri . '?updateProfile';
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = self::REQ_METHOD_PUT;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
