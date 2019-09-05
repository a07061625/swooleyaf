<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/23 0023
 * Time: 13:23
 */
namespace PoolService\ProcessService;

use SyConstant\Project;

class ProcessServiceManager extends BaseManager
{
    public function __construct()
    {
        parent::__construct();
        $this->projectServices = [
            Project::POOL_PROCESS_SERVICE_TAG_TEST => '\PoolService\ProcessService\Test',
        ];
    }

    private function __clone()
    {
    }
}
