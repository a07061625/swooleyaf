<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/23 0023
 * Time: 13:08
 */
namespace PoolService\ProcessService;

use SyConstant\ProjectBase;

abstract class BaseManager
{
    protected $projectServices = [];
    private $frameServices = [];

    public function __construct()
    {
        $this->frameServices = [
            ProjectBase::POOL_PROCESS_SERVICE_TAG_ENV_INFO => '\PoolService\ProcessService\EnvInfo',
        ];
    }

    private function __clone()
    {
    }

    public function getServiceName(string $serviceTag)
    {
        if (isset($this->frameServices[$serviceTag])) {
            return $this->frameServices[$serviceTag];
        } elseif (isset($this->projectServices[$serviceTag])) {
            return $this->projectServices[$serviceTag];
        } else {
            return '';
        }
    }
}
