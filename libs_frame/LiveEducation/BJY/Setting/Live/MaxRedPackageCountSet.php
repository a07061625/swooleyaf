<?php
/**
 * 修改红包最大个数限制
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace LiveEducation\BJY\Setting\Live;

use LiveEducation\BJY\Setting\BaseSetting;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class MaxRedPackageCountSet
 * @package LiveEducation\BJY\Setting\Live
 */
class MaxRedPackageCountSet extends BaseSetting
{
    /**
     * 最大红包限制个数,最大不超过1000
     * @var int
     */
    private $max_count = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/setMaxRedPackageCount';
    }

    private function __clone()
    {
    }

    /**
     * @param int $maxCount
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setMaxCount(int $maxCount)
    {
        if (($maxCount > 0) && ($maxCount <= 1000)) {
            $this->reqData['max_count'] = $maxCount;
        } else {
            throw new BJYException('最大红包限制个数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['max_count'])) {
            throw new BJYException('最大红包限制个数不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
