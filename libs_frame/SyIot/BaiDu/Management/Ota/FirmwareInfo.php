<?php
/**
 * 获取固件包详情
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Management\Ota;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;

class FirmwareInfo extends BaseBaiDu
{
    /**
     * 固件包ID
     *
     * @var string
     */
    private $firmwareId = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $firmwareId
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setFirmwareId(string $firmwareId)
    {
        if (strlen($firmwareId) > 0) {
            $this->firmwareId = $firmwareId;
            $this->serviceUri = '/v3/iot/management/ota/firmware/' . $firmwareId;
        } else {
            throw new BaiDuIotException('固件包ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->firmwareId) == 0) {
            throw new BaiDuIotException('固件包ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
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
