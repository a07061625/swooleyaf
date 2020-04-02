<?php
/**
 * 获取指定分类下的视频
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace LiveEducation\BJY\VOD\Video;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class CategoryVideoGet
 * @package LiveEducation\BJY\VOD\Video
 */
class CategoryVideoGet extends BaseBJY
{
    /**
     * 分类ID
     * @var int
     */
    private $category_id = 0;
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
        $this->serviceUri = '/openapi/video/getCategoryVideo';
        $this->reqData['page'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @param int $categoryId
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setCategoryId(int $categoryId)
    {
        if ($categoryId > 0) {
            $this->reqData['category_id'] = $categoryId;
        } else {
            throw new BJYException('分类ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
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
        if (($pageSize > 0) && ($pageSize <= 100)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new BJYException('每页条数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['category_id'])) {
            throw new BJYException('分类ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
