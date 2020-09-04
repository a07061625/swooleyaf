<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 11:35
 */
namespace SyLive;

use DesignPatterns\Singletons\LiveConfigSingleton;

/**
 * Class BaseTencent
 *
 * @package SyLive
 */
abstract class BaseTencent extends \SyCloud\Tencent\Base
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceName = 'live';
        $this->serviceDomain = 'live.tencentcloudapi.com';
        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->reqHeader['Host'] = $this->serviceDomain;
        $this->reqHeader['X-TC-Region'] = $config->getRegionId();
        $this->reqHeader['X-TC-Version'] = '2018-08-01';
    }

    private function __clone()
    {
    }
}
