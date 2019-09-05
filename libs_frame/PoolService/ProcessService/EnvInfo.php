<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/23 0023
 * Time: 13:17
 */
namespace PoolService\ProcessService;

use Response\Result;
use SyTrait\SimpleTrait;

class EnvInfo extends BaseService
{
    use SimpleTrait;

    protected static function handleMessage(array $data) : Result
    {
        ob_start();
        phpinfo();
        $phpInfo = ob_get_contents();
        ob_end_clean();

        $result = new Result();
        $result->setData([
            'env_info' => $phpInfo,
        ]);
        return $result;
    }
}
