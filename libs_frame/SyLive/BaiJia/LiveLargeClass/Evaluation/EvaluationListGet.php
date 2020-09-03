<?php
/**
 * 获取课后评价模板列表
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:21
 */
namespace SyLive\BaiJia\LiveLargeClass\Evaluation;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class EvaluationListGet
 * @package SyLive\BaiJia\LiveLargeClass\Evaluation
 */
class EvaluationListGet extends BaseBaiJia
{
    /**
     * 模板状态,默认返回所有 0:未发布 1:已发布
     * @var int
     */
    private $status = 0;
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
        $this->serviceUri = '/openapi/evaluation/getEvaluationList';
    }

    private function __clone()
    {
    }

    /**
     * @param int $status
     * @throws \SyException\Live\BaiJiaException
     */
    public function setStatus(int $status)
    {
        if (in_array($status, [0, 1])) {
            $this->reqData['status'] = $status;
        } else {
            throw new BaiJiaException('模板状态不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $page
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new BaiJiaException('页数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 1000)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new BaiJiaException('每页条数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
