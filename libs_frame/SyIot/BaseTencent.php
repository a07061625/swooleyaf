<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/23 0023
 * Time: 8:53
 */
namespace SyIot;

use DesignPatterns\Singletons\IotConfigSingleton;

abstract class BaseTencent extends \SyCloud\Tencent\Base
{
    public function __construct()
    {
        parent::__construct();
        $this->serviceName = 'iot';
        $this->serviceDomain = 'iotexplorer.tencentcloudapi.com';
        $config = IotConfigSingleton::getInstance()->getTencentConfig();
        $this->reqHeader['Host'] = $this->serviceDomain;
        $this->reqHeader['X-TC-Region'] = $config->getRegionId();
        $this->reqHeader['X-TC-Version'] = '2019-04-23';
    }

    private function __clone()
    {
    }
}
