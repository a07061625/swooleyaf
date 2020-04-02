<?php
/**
 * 获取账号所有视频观看记录
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace LiveEducation\BJY\VOD\VideoData;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class VideoReportBatchExport
 * @package LiveEducation\BJY\VOD\VideoData
 */
class VideoReportBatchExport extends BaseBJY
{
    /**
     * 产品类型 1:教育直播 2:小班课 3:双师 4:企业直播 5:点播账号
     * @var int
     */
    private $product_type = 0;
    /**
     * 开始日期
     * @var string
     */
    private $start_time = '';
    /**
     * 结束日期
     * @var string
     */
    private $end_time = '';
    /**
     * 页数
     * @var int
     */
    private $page = 0;
    /**
     * 每页条数
     * @var int
     */
    private $page_size = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video_data/exportVideoReportBatch';
        $this->reqData['page'] = 1;
        $this->reqData['page_size'] = 100;
    }

    private function __clone()
    {
    }

    /**
     * @param int $productType
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setProductType(int $productType)
    {
        if (in_array($productType, [1, 2, 3, 4, 5])) {
            $this->reqData['product_type'] = $productType;
        } else {
            throw new BJYException('产品类型不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setTime(int $startTime, int $endTime)
    {
        if ($startTime <= 0) {
            throw new BJYException('开始时间不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } else if ($startTime > $endTime) {
            throw new BJYException('开始时间不能大于结束时间', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } else if(($endTime - $startTime) > 86400){
            throw new BJYException('结束时间不能大于开始时间24小时', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['start_time'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['end_time'] = date('Y-m-d H:i:s', $endTime);
    }

    /**
     * @param int $page
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new BJYException('页数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 1000)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new BJYException('每页条数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['start_time'])) {
            throw new BJYException('开始时间不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
