<?php
/**
 * 查询直播上下课回调地址
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:50
 */
namespace LiveEducation\BJY\Live\LargeClass\LiveAccount;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;

/**
 * Class ClassCallbackUrlGet
 * @package LiveEducation\BJY\Live\LargeClass\LiveAccount
 */
class ClassCallbackUrlGet extends BaseBJY
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_account/getClassCallbackUrl';
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
