<?php
/**
 * 更新单个设备注册表信息
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

class DeviceRegistryUpdate extends BaseBaiDu
{
    /**
     * 设备名称
     *
     * @var string
     */
    private $deviceName = '';
    /**
     * 设备描述
     *
     * @var string
     */
    private $description = '';
    /**
     * 物模型ID
     *
     * @var string
     */
    private $schemaId = '';
    /**
     * 收藏标识
     *
     * @var bool
     */
    private $favourite = true;

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
     * @param string $description
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setDescription(string $description)
    {
        if (strlen($description) > 0) {
            $this->reqData['description'] = $description;
        } else {
            throw new BaiDuIotException('设备描述不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $schemaId
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setSchemaId(string $schemaId)
    {
        if (strlen($schemaId) > 0) {
            $this->reqData['schemaId'] = $schemaId;
        } else {
            throw new BaiDuIotException('物模型ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param bool $favourite
     */
    public function setFavourite(bool $favourite)
    {
        $this->reqData['favourite'] = $favourite;
    }

    public function getDetail() : array
    {
        if (strlen($this->deviceName) > 0) {
            throw new BaiDuIotException('设备名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if ((!isset($this->reqData['description'])) && (!isset($this->reqData['schemaId'])) && (!isset($this->reqData['favourite']))) {
            throw new BaiDuIotException('设备描述,物模型ID,收藏标识不能都为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_PUT,
            'req_uri' => $this->serviceUri,
            'req_params' => [
                'updateRegistry' => '',
            ],
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri . '?updateRegistry';
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = self::REQ_METHOD_PUT;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
