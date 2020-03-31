<?php
/**
 * 查询子账号列表
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 13:42
 */
namespace LiveEducation\BJY\SubAccount;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class SubAccountListGet
 * @package LiveEducation\BJY\SubAccount
 */
class SubAccountListGet extends BaseBJY
{
    /**
     * 账号状态 0:全部 1:使用中 2:停用或未开通的
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
        $this->serviceUri = '/openapi/sub_account/getSubAccountList';
        $this->reqData['status'] = 0;
        $this->reqData['page'] = 1;
        $this->reqData['page_size'] = 10;
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
        if (in_array($status, [0, 1, 2])) {
            $this->reqData['status'] = $status;
        } else {
            throw new BJYException('账号状态不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
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
        if ($pageSize > 0) {
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
