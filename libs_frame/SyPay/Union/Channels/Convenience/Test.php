<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/13 0013
 * Time: 10:19
 */
namespace SyPay\Union\Channels\Convenience;

use SyConstant\ErrorCode;
use SyPay\Union\Channels\BaseConvenience;

/**
 * Class Test
 * @package SyPay\Union\Channels\Convenience
 */
class Test extends BaseConvenience
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
