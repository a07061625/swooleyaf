<?php
/**
 * 设备远程控制
 * User: 姜伟
 * Date: 2019/7/24 0024
 * Time: 14:07
 */
namespace SyIot\Tencent\Device;

use DesignPatterns\Singletons\IotConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Iot\TencentIotException;
use SyIot\BaseTencent;
use SyTool\Tool;

class DeviceDataControl extends BaseTencent
{
    /**
     * 产品ID
     *
     * @var string
     */
    private $ProductId = '';
    /**
     * 设备名称
     *
     * @var string
     */
    private $DeviceName = '';
    /**
     * 属性数据
     *
     * @var array
     */
    private $Data = [];

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'ControlDeviceData';
    }

    private function __clone()
    {
    }

    /**
     * @param string $productId
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setProductId(string $productId)
    {
        if (ctype_alnum($productId)) {
            $this->reqData['ProductId'] = $productId;
        } else {
            throw new TencentIotException('产品ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $deviceName
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setDeviceName(string $deviceName)
    {
        if (strlen($deviceName) > 0) {
            $this->reqData['DeviceName'] = $deviceName;
        } else {
            throw new TencentIotException('设备名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param array $data
     *
     * @throws \SyException\Iot\TencentIotException
     */
    public function setData(array $data)
    {
        if (empty($data)) {
            throw new TencentIotException('属性数据不合法', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->reqData['Data'] = Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['ProductId'])) {
            throw new TencentIotException('产品ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['DeviceName'])) {
            throw new TencentIotException('设备名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['Data'])) {
            throw new TencentIotException('属性数据不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
