<?php
/**
 * 获取所有分类
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 18:54
 */
namespace LiveEducation\BJY\VOD\Video;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;

/**
 * Class CategoryListGet
 * @package LiveEducation\BJY\VOD\Video
 */
class CategoryListGet extends BaseBJY
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video/getCategoryList';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
