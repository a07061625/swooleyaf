<?php
/**
 * 创建升级任务
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

class JobCreate extends BaseBaiDu
{
    /**
     * 任务名称
     *
     * @var string
     */
    private $jobName = '';
    /**
     * 固件包ID
     *
     * @var string
     */
    private $firmwareId = '';
    /**
     * 描述
     *
     * @var string
     */
    private $description = '';
    /**
     * 设备名称列表
     *
     * @var array
     */
    private $devices = [];
    /**
     * 版本列表
     *
     * @var array
     */
    private $versionFilter = [];

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/v3/iot/management/ota/job';
        $this->reqData['versionFilter'] = [];
    }

    private function __clone()
    {
    }

    /**
     * @param string $jobName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setJobName(string $jobName)
    {
        if (strlen($jobName) > 0) {
            $this->reqData['jobName'] = $jobName;
        } else {
            throw new BaiDuIotException('任务名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param string $firmwareId
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setFirmwareId(string $firmwareId)
    {
        if (strlen($firmwareId) > 0) {
            $this->reqData['firmwareId'] = $firmwareId;
        } else {
            throw new BaiDuIotException('固件包ID不合法', ErrorCode::IOT_PARAM_ERROR);
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

    /**
     * @param array $versionList
     */
    public function setVersionList(array $versionList)
    {
        foreach ($versionList as $eVersion) {
            if (is_string($eVersion) && (strlen($eVersion) > 0)) {
                $this->versionFilter[$eVersion] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['jobName'])) {
            throw new BaiDuIotException('任务名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!isset($this->reqData['firmwareId'])) {
            throw new BaiDuIotException('固件包ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (!empty($this->devices)) {
            $this->reqData['devices'] = array_keys($this->devices);
        }
        $this->reqData['versionFilter'] = array_keys($this->versionFilter);

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
