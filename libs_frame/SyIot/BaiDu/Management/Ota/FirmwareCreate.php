<?php
/**
 * 创建固件包
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

class FirmwareCreate extends BaseBaiDu
{
    /**
     * 物模型ID
     *
     * @var string
     */
    private $schemaId = '';
    /**
     * 描述
     *
     * @var string
     */
    private $description = '';
    /**
     * 版本号
     *
     * @var string
     */
    private $version = '';
    /**
     * 固件包文件ID
     *
     * @var string
     */
    private $fileId = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v3/iot/management/ota/firmware';
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
     * @param string $version
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setVersion(string $version)
    {
        if (version_compare($version, '0.0.0', '>')) {
            $this->reqData['version'] = $version;
        } else {
            throw new BaiDuIotException('版本号不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $fileId
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setFileId(string $fileId)
    {
        if (strlen($fileId) > 0) {
            $this->reqData['fileId'] = $fileId;
        } else {
            throw new BaiDuIotException('固件包文件ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['schemaId'])) {
            throw new BaiDuIotException('物模型ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['description'])) {
            throw new BaiDuIotException('描述不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['version'])) {
            throw new BaiDuIotException('版本号不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['fileId'])) {
            throw new BaiDuIotException('固件包文件ID不能为空', ErrorCode::IOT_PARAM_ERROR);
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
