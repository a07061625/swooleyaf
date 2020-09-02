<?php
/**
 * 创建单个设备
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

class DeviceCreate extends BaseBaiDu
{
    /**
     * 设备名称
     *
     * @var string
     */
    private $deviceName = '';
    /**
     * 描述
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

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v3/iot/management/device';
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
            $this->reqData['deviceName'] = $deviceName;
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
            throw new BaiDuIotException('描述不合法', ErrorCode::IOT_PARAM_ERROR);
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['deviceName'])) {
            throw new BaiDuIotException('设备名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['description'])) {
            throw new BaiDuIotException('描述不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['schemaId'])) {
            throw new BaiDuIotException('物模型ID不能为空', ErrorCode::IOT_PARAM_ERROR);
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
