<?php
/**
 * 获取跑马灯设置
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:53
 */
namespace LiveEducation\BJY\Setting\Live;

use LiveEducation\BJY\Setting\BaseSetting;
use LiveEducation\UtilBJY;

/**
 * Class LiveHorseLampGet
 * @package LiveEducation\BJY\Setting\Live
 */
class LiveHorseLampGet extends BaseSetting
{
    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_setting/getLiveHorseLamp';
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
