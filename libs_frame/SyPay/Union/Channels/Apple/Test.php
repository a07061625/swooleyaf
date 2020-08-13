<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 9:40
 */
namespace SyPay\Union\Channels\Apple;

use SyConstant\ErrorCode;
use SyPay\Union\Channels\BaseApple;

/**
 * Class Test
 *
 * @package SyPay\Union\Channels\Apple
 */
class Test extends BaseApple
{
    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
    }

    public function __clone()
    {
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => ErrorCode::COMMON_SUCCESS,
        ];

        return $resArr;
    }
}
