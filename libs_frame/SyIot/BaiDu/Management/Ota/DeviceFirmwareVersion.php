<?php
/**
 * 查询设备使用固件包版本
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Management\Ota;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;
use SyTool\Tool;

class DeviceFirmwareVersion extends BaseBaiDu
{
    /**
     * 物模型ID
     *
     * @var string
     */
    private $schemaId = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v3/iot/management/ota/device-firmware-version-query';
    }

    private function __clone()
    {
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
