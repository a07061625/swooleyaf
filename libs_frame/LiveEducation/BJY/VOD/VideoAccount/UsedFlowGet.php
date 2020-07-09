<?php
/**
 * 查询账号一段时间内使用的流量
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace LiveEducation\BJY\VOD\VideoAccount;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class UsedFlowGet
 * @package LiveEducation\BJY\VOD\VideoAccount
 */
class UsedFlowGet extends BaseBJY
{
    /**
     * 开始日期
     * @var string
     */
    private $start_date = '';
    /**
     * 结束日期
     * @var string
     */
    private $end_date = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video_account/getUsedFlow';
    }

    private function __clone()
    {
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setDate(int $startTime, int $endTime)
    {
        if ($startTime <= 0) {
            throw new BJYException('开始时间不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } elseif ($startTime > $endTime) {
            throw new BJYException('开始时间不能大于结束时间', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['start_date'] = date('Y-m-d', $startTime);
        $this->reqData['end_date'] = date('Y-m-d', $endTime);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['start_date'])) {
            throw new BJYException('开始时间不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
