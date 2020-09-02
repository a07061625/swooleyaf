<?php
/**
 * 查询特定实例某个时间段内的使用量
 * User: 姜伟
 * Date: 2019/7/17 0017
 * Time: 17:14
 */
namespace SyIot\BaiDu\Usage;

use SyConstant\ErrorCode;
use SyException\Iot\BaiDuIotException;
use SyIot\BaseBaiDu;
use SyIot\UtilBaiDu;

class UsageEndpointQuery extends BaseBaiDu
{
    /**
     * endpoint名称
     *
     * @var string
     */
    private $endpointName = '';
    /**
     * 开始日期(包含)
     *
     * @var string
     */
    private $start = '';
    /**
     * 结束日期(不包含)
     *
     * @var string
     */
    private $end = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
    }

    /**
     * @param string $endpointName
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setEndpointName(string $endpointName)
    {
        if (ctype_alnum($endpointName)) {
            $this->endpointName = $endpointName;
            $this->serviceUri = '/v1/endpoint/' . $this->endpointName . '/usage-query';
        } else {
            throw new BaiDuIotException('endpoint名称不合法', ErrorCode::IOT_PARAM_ERROR);
        }
    }

    /**
     * @param int $startTime
     * @param int $endTime
     *
     * @throws \SyException\Iot\BaiDuIotException
     */
    public function setQueryTime(int $startTime, int $endTime)
    {
        if ($startTime <= 1000000000) {
            throw new BaiDuIotException('开始时间不合法', ErrorCode::IOT_PARAM_ERROR);
        } elseif ($endTime <= $startTime) {
            throw new BaiDuIotException('结束时间必须大于开始时间', ErrorCode::IOT_PARAM_ERROR);
        }

        $startDay = date('Y-m-d', $startTime);
        $endDay = date('Y-m-d', $endTime);
        if ($startDay == $endDay) {
            throw new BaiDuIotException('开始时间和结束时间不能在同一天', ErrorCode::IOT_PARAM_ERROR);
        }
        $this->start = $startDay;
        $this->end = $endDay;
    }

    public function getDetail() : array
    {
        if (strlen($this->endpointName) == 0) {
            throw new BaiDuIotException('endpoint名称不能为空', ErrorCode::IOT_PARAM_ERROR);
        }
        if (strlen($this->start) == 0) {
            throw new BaiDuIotException('开始日期不能为空', ErrorCode::IOT_PARAM_ERROR);
        }

        $queryData = [
            'start' => $this->start,
            'end' => $this->end,
        ];
        $this->reqHeader['Authorization'] = UtilBaiDu::createSign([
            'req_method' => self::REQ_METHOD_POST,
            'req_uri' => $this->serviceUri,
            'req_params' => $queryData,
            'req_headers' => [
                'host',
            ],
        ]);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceProtocol . '://' . $this->serviceDomain . $this->serviceUri . '?' . http_build_query($queryData);
        $this->curlConfigs[CURLOPT_POST] = true;

        return $this->getContent();
    }
}
