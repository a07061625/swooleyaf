<?php
/**
 * 上传升级设备文件
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Management\Ota;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;

class DeviceFileUpload extends BaseBaiDu
{
    /**
     * 文件全路径,包括文件名
     *
     * @var string
     */
    private $file_path = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v3/iot/management/ota/device-file';
        $this->reqData['Content-Type'] = 'multipart/form-data';
    }

    private function __clone()
    {
    }

    /**
     * @param string $filePath
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setFilePath(string $filePath)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            $this->reqData['file'] = new \CURLFile($filePath);
        } else {
            throw new BaiDuIotException('文件不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['file'])) {
            throw new BaiDuIotException('文件不能为空', ErrorCode::IOT_PARAM_ERROR);
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
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;

        return $this->getContent();
    }
}
