<?php
/**
 * 获取指定ID分类信息
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
 * Class CategoryGet
 * @package LiveEducation\BJY\VOD\Video
 */
class CategoryGet extends BaseBJY
{
    /**
     * 分类ID
     * @var int
     */
    private $category_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/getCategoryInfo';
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['category_id'])) {
            throw new BJYException('分类ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
