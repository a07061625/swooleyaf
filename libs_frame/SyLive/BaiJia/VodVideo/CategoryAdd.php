<?php
/**
 * 添加分类
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
 * Class CategoryAdd
 * @package SyLive\BaiJia\VodVideo
 */
class CategoryAdd extends BaseBaiJia
{
    /**
     * 父分类ID
     * @var int
     */
    private $parent_id = 0;
    /**
     * 分类名称
     * @var string
     */
    private $name = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/addCategory';
        $this->reqData['parent_id'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param int $parentId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setParentId(int $parentId)
    {
        if ($parentId >= 0) {
            $this->reqData['parent_id'] = $parentId;
        } else {
            throw new BaiJiaException('父分类ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param string $name
     * @throws \SyException\Live\BaiJiaException
     */
    public function setName(string $name)
    {
        $trueName = trim($name);
        if (strlen($trueName) > 0) {
            $this->reqData['name'] = $trueName;
        } else {
            throw new BaiJiaException('分类名称不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['name'])) {
            throw new BaiJiaException('分类名称不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
