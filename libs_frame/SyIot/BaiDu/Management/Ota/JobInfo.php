<?php
/**
 * 查询升级任务
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Management\Ota;

use Constant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\IotBaseBaiDu;
use SyIot\IotUtilBaiDu;

class JobInfo extends IotBaseBaiDu
{
    /**
     * 任务ID
     * @var string
     */
    private $jobId = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $jobId
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setJobId(string $jobId)
    {
        if (strlen($jobId) > 0) {
            $this->jobId = $jobId;
            $this->serviceUri = '/v3/iot/management/ota/job/' . $jobId;
        } else {
            throw new BaiDuIotException('任务ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->jobId) == 0) {
            throw new BaiDuIotException('任务ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = IotUtilBaiDu::createSign([
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
