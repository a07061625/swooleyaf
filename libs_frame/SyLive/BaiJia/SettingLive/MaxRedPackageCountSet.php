<?php
/**
 * 修改红包最大个数限制
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace SyLive\BaiJia\SettingLive;

use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class MaxRedPackageCountSet
 * @package SyLive\BaiJia\SettingLive
 */
class MaxRedPackageCountSet extends BaseBaiJiaSetting
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
     * @throws \SyException\Live\BaiJiaException
     */
    public function setMaxCount(int $maxCount)
    {
        if (($maxCount > 0) && ($maxCount <= 1000)) {
            $this->reqData['max_count'] = $maxCount;
        } else {
            throw new BaiJiaException('最大红包限制个数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['max_count'])) {
            throw new BaiJiaException('最大红包限制个数不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
