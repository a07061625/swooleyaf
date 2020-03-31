<?php
/**
 * 获取课后评价模板列表
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:21
 */
namespace LiveEducation\BJY\Live\LargeClass\Evaluation;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class EvaluationListGet
 * @package LiveEducation\BJY\Live\LargeClass\Evaluation
 */
class EvaluationListGet extends BaseBJY
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
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setStatus(int $status)
    {
        if (in_array($status, [0, 1])) {
            $this->reqData['status'] = $status;
        } else {
            throw new BJYException('模板状态不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
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
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
