<?php
/**
 * 删除分类
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace SyLive\BaiJia\VodVideo;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class CategoryDelete
 * @package SyLive\BaiJia\VodVideo
 */
class CategoryDelete extends BaseBaiJia
{
    /**
     * 分类ID
     * @var int
     */
    private $category_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/deleteCategory';
    }

    private function __clone()
    {
    }

    /**
     * @param int $categoryId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setCategoryId(int $categoryId)
    {
        if ($categoryId > 0) {
            $this->reqData['category_id'] = $categoryId;
        } else {
            throw new BaiJiaException('分类ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['category_id'])) {
            throw new BaiJiaException('分类ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
