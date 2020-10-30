<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/3/23 0023
 * Time: 13:21
 */
namespace PoolService\ProcessService;

use Response\Result;
use SyTrait\SimpleTrait;

class Test extends BaseService
{
    use SimpleTrait;

    protected static function handleMessage(array $data) : Result
    {
        $result = new Result();
        $result->setData([
            'msg' => 'hello world',
        ]);

        return $result;
    }
}
