<?php
/**
 * 查询升级任务各设备升级结果
 * User: 姜伟
 * Date: 2019/7/18 0018
 * Time: 23:59
 */
namespace SyIot\BaiDu\Management\Ota;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;

class JobDeviceResult extends BaseBaiDu
{
    /**
     * 任务ID
     *
     * @var string
     */
    private $jobId = '';
    /**
     * 页码
     *
     * @var int
     */
    private $pageNo = 1;
    /**
     * 每页个数
     *
     * @var int
     */
    private $pageSize = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqData['pageNo'] = 1;
        $this->reqData['pageSize'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param string $jobId
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setJobId(string $jobId)
    {
        if (strlen($jobId) > 0) {
            $this->jobId = $jobId;
            $this->serviceUri = '/v3/iot/management/ota/job/' . $jobId . '/device-result';
        } else {
            throw new BaiDuIotException('任务ID不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageNo
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPageNo(int $pageNo)
    {
        if ($pageNo > 0) {
            $this->reqData['pageNo'] = $pageNo;
        } else {
            throw new BaiDuIotException('页码不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 100)) {
            $this->reqData['pageSize'] = $pageSize;
        } else {
            throw new BaiDuIotException('每页个数不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->jobId) == 0) {
            throw new BaiDuIotException('任务ID不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_GET,
            'req_uri' => $this->serviceUri,
            'req_params' => $this->reqData,
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri . '?' . http_build_query($this->reqData);

        return $this->getContent();
    }
}
