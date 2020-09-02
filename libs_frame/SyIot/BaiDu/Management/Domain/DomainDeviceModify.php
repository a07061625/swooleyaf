<?php
/**
 * 权限组中更改设备
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Management\Domain;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class DomainDeviceModify extends BaseBaiDu
{
    /**
     * 权限组名称
     *
     * @var string
     */
    private $domainName = '';
    /**
     * 添加设备名称列表
     *
     * @var array
     */
    private $addedDevices = [];
    /**
     * 移除设备名称列表
     *
     * @var array
     */
    private $removedDevices = [];

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $domainName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setDomainName(string $domainName)
    {
        if (ctype_alnum($domainName)) {
            $this->domainName = $domainName;
            $this->serviceUri = '/v3/iot/management/domain/' . $domainName;
        } else {
            throw new BaiDuIotException('权限组名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param array $addedDevices
     */
    public function setAddedDevices(array $addedDevices)
    {
        foreach ($addedDevices as $eDeviceName) {
            if (ctype_alnum($eDeviceName)) {
                $this->addedDevices[$eDeviceName] = 1;
            }
        }
    }

    /**
     * @param array $removedDevices
     */
    public function setRemovedDevices(array $removedDevices)
    {
        foreach ($removedDevices as $eDeviceName) {
            if (ctype_alnum($eDeviceName)) {
                $this->removedDevices[$eDeviceName] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->domainName) == 0) {
            throw new BaiDuIotException('权限组名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (empty($this->addedDevices) && empty($this->removedDevices)) {
            throw new BaiDuIotException('添加和移除的设备名称列表不能都为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!empty($this->addedDevices)) {
            $this->reqData['addedDevices'] = array_keys($this->addedDevices);
        }
        if (!empty($this->removedDevices)) {
            $this->reqData['removedDevices'] = array_keys($this->removedDevices);
        }

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_PUT,
            'req_uri' => $this->serviceUri,
            'req_params' => [
                'modify' => '',
            ],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri . '?modify';
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = self::REQ_METHOD_PUT;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
